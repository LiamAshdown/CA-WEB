<template>
  <v-container class="feed" fluid>
    <feeds></feeds>
    <post-dial></post-dial>
  </v-container>
</template>

<script>
import Feeds from '@/components/partials/feed/Feeds'
import PostDial from '@/components/partials/feed/PostDial'

export default {
  name: 'FeedPage',
  components: {
    Feeds,
    PostDial
  }
}
</script>

<style lang="scss" scoped>
.feed {
  padding-top: 1px;
  padding-left: 0px;
  padding-right: 0px;
  margin-top: 10px;
}
</style>
