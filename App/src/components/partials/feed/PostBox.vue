<template>
  <div
    :class="[
      'post-box',
      {
        'has-exceeded-limit': limitStatus > 100,
      },
    ]"
  >
    <div
      class="post-box__htmlarea"
      aria-hidden
    >{{ valueAllowed }}<em v-if="valueExcess">{{ valueExcess }}</em></div>
    <textarea
      ref="textarea"
      class="post-box__textarea"
      :value="value"
      placeholder="What's on your mind?"
      rows="6"
      @input="updateValue"
    />
    <div class="post-box__limit">
      <span class="post-box__remainingCharacters">
        {{ remainingCharacters }}
      </span>
      <svg
        class="post-box__counter"
        viewBox="0 0 33.83098862 33.83098862"
        height="20"
        width="20"
        xmlns="http://www.w3.org/2000/svg"
      >
        <circle
          class="post-box__counterUnderlay"
          cx="16.91549431"
          cy="16.91549431"
          r="15.91549431"
          fill="none"
          stroke-width="2"
        />
        <circle
          class="post-box__counterProgress"
          :stroke-dasharray="`${limitStatus},100`"
          cx="16.91549431"
          cy="16.91549431"
          r="15.91549431"
          fill="none"
          stroke-width="4"
        />
      </svg>
    </div>
  </div>
</template>

<script>
export default {
  name: 'PostBox',
  props: {
    limit: {
      type: Number,
      default: 140
    }
  },
  data () {
    return {
      value: ''
    }
  },
  computed: {
    valueAllowed () {
      return this.limit ? this.value.slice(0, this.limit) : this.value
    },
    valueExcess () {
      return this.limit ? this.value.slice(this.limit) : ''
    },
    limitStatus () {
      return (this.value.length / this.limit) * 100
    },
    remainingCharacters () {
      return this.limit - this.value.length
    },
    textareaStyle () {
      return getComputedStyle(this.$refs.textarea)
    }
  },
  methods: {
    updateValue (e) {
      this.textareaGrow()

      this.value = e.target.value

      // Update post button enable
      this.$store.dispatch('feed/setPost', {
        can: this.remainingCharacters > 0,
        text: this.value
      })
    },
    textareaGrow () {
      const paddingTop = parseInt(this.textareaStyle.getPropertyValue('padding-top'), 10)
      const paddingBottom = parseInt(this.textareaStyle.getPropertyValue('padding-bottom'), 10)
      const lineHeight = parseInt(this.textareaStyle.getPropertyValue('line-height'), 10)

      this.$refs.textarea.rows = 1
      const innerHeight = this.$refs.textarea.scrollHeight - paddingTop - paddingBottom
      this.$refs.textarea.rows = innerHeight / lineHeight
    }
  },
  mounted () {
    this.textareaGrow()
  }
}
</script>

<style lang="scss">
.post-box {
  $color-border: #99dde6;
  $color-danger: #e0245e;
  $color-danger-light: #ffb8c2;
  $color-gray: #657786;
  $color-gray-light: #ccd6dd;
  $color-primary: #1da1f2;
  position: relative;
  &__htmlarea,
  &__textarea {
    padding: 1em;
    padding-right: 3.75em;
    width: 100%;
    line-height: 1.25;
    border-radius: 0.5em;
  }
  &__htmlarea {
    position: absolute; // 1
    height: 100%; // 1
    background-color: #fff;
    color: transparent;
    white-space: pre-wrap;
    word-wrap: break-word;
  }
  &__textarea {
    display: block; // 1
    position: relative;
    border-color: $color-border;
    outline: 0;
    background-color: transparent;
    resize: none;
    &:focus {
      border-color: darken($color-border, 20%);
    }
  }
  em {
    background: $color-danger-light;
  }
  &__limit {
    display: flex;
    position: absolute;
    right: 0.75em;
    bottom: 0.75em;
    align-items: center;
  }
  &__remainingCharacters {
    margin-right: 0.5em;
    color: $color-gray;
    font-size: 0.75em;
    .has-exceeded-limit & {
      color: $color-danger;
    }
  }

  &__counter {
    overflow: visible; // 1
    transform: rotate(-90deg);
    transform-origin: center;
  }
  &__counterUnderlay {
    stroke: $color-gray-light;
  }
  &__counterProgress {
    stroke: $color-primary;
    .has-exceeded-limit & {
      stroke: $color-danger;
      animation: counterPulse 0.3s ease-in-out;
      animation-iteration-count: 1;
    }
  }
  @keyframes counterPulse {
    0% { stroke-width: 4; }
    50% { stroke-width: 6; }
    100% { stroke-width: 4; }
  }
}
</style>
