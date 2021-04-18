<template>
  <div class="base_card">
    <div class="base_card__loader" v-show="loading">
      <div class="base_card__loader__body">
      </div>
      <b-spinner type="grow" variant="primary" label="Loading..."></b-spinner>
    </div>
    <div class="base_card__body shadow-sm" :class="{['base_card--padded']: padding}">
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  name: 'BaseCard',
  props: {
    padding: {
      type: Boolean,
      required: false,
      default: true
    },
    loading: {
      type: Boolean,
      required: false,
      default: false
    }
  }
}
</script>

<style lang="scss">
.base_card {
  position: relative;

  &__loader {
    position: absolute;
    height: 100%;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 99;

    &__body {
      position: absolute;
      height: 100%;
      width: 100%;
      background-color: rgba(249,251,255,.9);
      opacity: 0.9;
    }
  }

  &__body {
    background-color: #fff;
    border-radius: 5px;
  }

  &--padded {
    padding: 1.25rem;
  }
}
</style>
