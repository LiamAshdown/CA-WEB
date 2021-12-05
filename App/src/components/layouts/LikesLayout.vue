<template>
  <div>
    <top-likes></top-likes>
    <main class="likes-layout">
      <slot></slot>
    </main>
  </div>
</template>

<script>
import TopLikes from '@/components/partials/navigation/TopLikes'

export default {
  name: 'LikesLayout',
  components: {
    TopLikes
  }
}
</script>

<style lang="scss">
.likes-layout {
  margin-top: 56px;
}
</style>
