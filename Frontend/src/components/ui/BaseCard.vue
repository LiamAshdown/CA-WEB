<template>
  <div class="content">
    <div class="content__loader" v-show="loading">
      <div class="content__loader__body">
      </div>
      <b-spinner type="grow" variant="primary" label="Loading..."></b-spinner>
    </div>
    <div class="content__body shadow-sm">
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  name: 'BaseCard',
  props: {
    loading: {
      type: Boolean,
      required: false,
      default: false
    }
  }
}
</script>

<style lang="scss">
.content {
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
    padding: 1.25rem;
    border-radius: 5px;
  }
}
</style>
