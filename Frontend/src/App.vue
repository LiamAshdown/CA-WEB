<template>
  <keep-alive include="CacheAuthenticatedLayout">
    <component :is="$route.meta.layout || 'div'">
      <router-view />
    </component>
  </keep-alive>
</template>

<script>
export default {
  name: 'App'
}
</script>
