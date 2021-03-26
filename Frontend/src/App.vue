<template>
  <div class="h-100">
    <component :is="$route.meta.layout || 'div'">
      <router-view />
    </component>
  </div>
</template>

<script>
export default {
  name: 'App'
}
</script>
