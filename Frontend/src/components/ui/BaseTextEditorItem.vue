<template>
  <button
    class="menu-item btn"
    :class="{ 'is-active': isActive ? isActive(): null }"
    @click="action"
    :title="title"
  >
  <template v-if=" icon == 'H1' || icon == 'H2' || icon == 'H3'">
    <b>{{ icon }}</b>
  </template>
  <font-awesome-icon :icon="icon" v-else/>
  </button>
</template>

<script>
export default {
  props: {
    icon: {
      type: String,
      required: true
    },

    title: {
      type: String,
      required: true
    },

    action: {
      type: Function,
      required: true
    },

    isActive: {
      type: Function,
      default: null
    }
  }
}
</script>

<style lang="scss" scoped>
.menu-item {
  border: none;
  border-radius: 0.4rem;
  margin-right: 0.25rem;

  &.is-active,
  &:hover {
    background-color: #e2e8f0;
  }
}
</style>
