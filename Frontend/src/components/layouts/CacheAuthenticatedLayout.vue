<template>
  <authenticated-layout>
    <slot></slot>
  </authenticated-layout>
</template>

<script>
import AuthenticatedLayout from './AuthenticatedLayout.vue'

export default {
  components: { AuthenticatedLayout },
  name: 'CacheAuthenticatedLayout'
}
</script>
