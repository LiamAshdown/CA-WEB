<template>
  <v-container>
    <post-box></post-box>
  </v-container>
</template>

<script>
import PostBox from '@/components/partials/feed/PostBox'

export default {
  name: 'PostPage',
  components: {
    PostBox
  }
}
</script>
