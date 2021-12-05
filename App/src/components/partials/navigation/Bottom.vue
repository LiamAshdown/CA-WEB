<template>
  <v-bottom-navigation
    :value="1"
    elevation="0"
    color="primary"
    fixed
  >
    <v-btn :to="{ name: 'feed' }">
      <span>Feed</span>
      <v-icon>mdi-newspaper</v-icon>
    </v-btn>

    <v-btn>
      <span>Portfolio</span>
      <v-icon>mdi-receipt</v-icon>
    </v-btn>
  </v-bottom-navigation>
</template>

<script>
export default {
  name: 'BottomNavigation'
}
</script>
