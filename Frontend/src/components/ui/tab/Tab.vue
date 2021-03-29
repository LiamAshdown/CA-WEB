<template>
  <div class='tab' v-if='isActive'>
    <slot></slot>
  </div>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      required: true
    },
    permission: {
      type: String,
      required: false,
      default: null
    }
  },
  data () {
    return {
      isActive: false
    }
  }
}
</script>
