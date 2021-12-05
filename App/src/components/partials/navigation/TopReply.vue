<template>
  <v-app-bar
    elevation="0"
    color="white"
    class="top-reply"
    fixed
  >
    <v-btn @click="back" icon>
      <v-icon>mdi-arrow-left</v-icon>
    </v-btn>

    <span class="text-button">Post</span>

  </v-app-bar>
</template>

<script>
export default {
  name: 'TopReplyNavigation',
  methods: {
    back () {
      this.$router.back()
    }
  }
}
</script>

<style lang="scss">
.top-reply {
  .v-toolbar__content {
    border-bottom: 2px solid #f3f6f7 !important;
  }
}
</style>
