<template>
  <v-toolbar
    fixed
    elevation="1"
    color="white"
  >
    <v-btn icon>
      <v-icon>mdi-arrow-left</v-icon>
    </v-btn>

    <v-spacer></v-spacer>

    <v-btn :to="{ name: 'profile' }" icon>
      <v-icon>mdi-account</v-icon>
    </v-btn>

  </v-toolbar>
</template>

<script>
export default {
  name: 'TopNavigation'
}
</script>
