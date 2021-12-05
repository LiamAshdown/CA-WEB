<template>
  <v-app-bar
    elevation="1"
    color="white"
    class="top-nav"
    elevate-on-scroll
    hide-on-scroll
  >
    <v-btn :to="{ name: 'profile' }" icon>
      <v-icon>mdi-account</v-icon>
    </v-btn>

    <v-spacer></v-spacer>

    <v-badge
        :content="messages"
        :value="messages"
        color="red"
        overlap
      >
        <v-icon @click="notifications">
          mdi-bell
        </v-icon>
      </v-badge>

  </v-app-bar>
</template>

<script>
export default {
  name: 'TopNavigation',
  data () {
    return {
      messages: 1
    }
  },
  methods: {
    notifications () {
      this.$router.push({ name: 'notifications' })
    }
  }
}
</script>

<style lang="scss">
.top-nav {
  position: fixed !important;
  top: 0;
  width: 100%;
  z-index: 99;
}
</style>
