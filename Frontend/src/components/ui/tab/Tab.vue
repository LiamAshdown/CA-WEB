<template>
  <div class='tab' v-if='isActive'>
    <slot></slot>
  </div>
</template>

<script>
export default {
  props: {
    title: {
      required: true,
      type: String
    }
  },
  data () {
    return {
      isActive: false
    }
  }
}
</script>
