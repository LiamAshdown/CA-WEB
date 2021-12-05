<template>
  <div class="authenticated-layout">
    <top-navigation></top-navigation>
    <main>
        <slot></slot>
    </main>
    <bottom-navigation></bottom-navigation>
  </div>
</template>

<script>
import TopNavigation from '@/components/partials/navigation/Top'
import BottomNavigation from '@/components/partials/navigation/Bottom'

export default {
  name: 'AuthenticatedLayout',
  components: {
    TopNavigation,
    BottomNavigation
  }
}
</script>

<style lang="scss">
.authenticated-layout {
  background-color: #f6f7fc;
  height: 100%;

  main {
    margin-top: 56px;
  }
}
</style>
