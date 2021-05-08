<template>
  <div id="tooltip" role="tooltip" :ref="tooltip" v-show="show">
    <div class="tooltip__header float-right">
      <font-awesome-icon icon="times" @click="close"/>
    </div>
    <div v-html="label"></div>
    <div id="arrow" data-popper-arrow></div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import { createPopper } from '@popperjs/core'
import { randomString } from '@/helpers/utils'

export default {
  name: 'BaseTooltip',
  props: {
    target: {
      required: true,
      type: String
    },
    label: {
      required: true,
      type: String
    },
    id: {
      required: true,
      type: String
    }
  },
  computed: {
    ...mapGetters({
      seen: 'seenTooltips'
    }),
    show () {
      return !this.seen.includes(this.id)
    }
  },
  data () {
    return {
      tooltip: randomString(),
      popper: null
    }
  },
  methods: {
    close () {
      this.$store.dispatch('setTooltipSeen', {
        tooltip: this.id
      })
    }
  },
  mounted () {
    this.$nextTick(() => {
      this.popper = createPopper(document.querySelector('#' + this.target), this.$refs[this.tooltip], {
        placement: 'bottom-start'
      })
    })
  }
}
</script>

<style lang="scss" scoped>
#tooltip {
  display: inline-block;
  color: white;
  background: $primary;
  font-weight: bold;
  padding: 5px 10px;
  font-size: 13px;
  border-radius: 4px;
}

.tooltip {
  &__header {
    svg {
      &:hover {
        cursor: pointer;
      }
    }
  }
}

#arrow,
#arrow::before {
  position: absolute;
  width: 8px;
  height: 8px;
  background: inherit;
}

#arrow {
  visibility: hidden;
}

#arrow::before {
  visibility: visible;
  content: '';
  transform: rotate(45deg);
}

#tooltip[data-popper-placement^='top'] > #arrow {
  bottom: -4px;
}

#tooltip[data-popper-placement^='bottom'] > #arrow {
  top: -4px;
}

#tooltip[data-popper-placement^='left'] > #arrow {
  right: -4px;
}

#tooltip[data-popper-placement^='right'] > #arrow {
  left: -4px;
}
</style>
