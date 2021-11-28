<template>
  <div>
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
