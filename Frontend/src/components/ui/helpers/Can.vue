<template>
  <div v-if="hasPermission">
    <slot></slot>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'Can',
  props: {
    has: {
      type: String,
      required: true
    }
  },
  computed: {
    ...mapGetters(['permissions']),
    hasPermission () {
      return this.permissions.some(permission => permission === this.has)
    }
  }
}
</script>
