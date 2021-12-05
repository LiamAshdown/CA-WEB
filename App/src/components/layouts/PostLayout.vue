<template>
  <div>
    <top-post-bar></top-post-bar>
    <main class="post-layout">
      <slot></slot>
    </main>
  </div>
</template>

<script>
import TopPostBar from '@/components/partials/navigation/TopPost'

export default {
  name: 'PostLayout',
  components: {
    TopPostBar
  }
}
</script>
