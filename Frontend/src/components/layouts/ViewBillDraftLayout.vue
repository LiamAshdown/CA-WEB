<template>
  <div class="h-100">
    <the-draft-navigation></the-draft-navigation>
    <main class="h-100 p-5">
      <slot></slot>
    </main>
  </div>
</template>

<script>
import TheDraftNavigation from '@/components/partials/Draft/TheDraftNavigation'

export default {
  name: 'ViewBillDraftLayout',
  components: {
    TheDraftNavigation
  }
}
</script>
