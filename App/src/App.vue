<template>
  <v-app>
    <v-main>
      <component :is="$route.meta.layout || 'div'">
        <router-view />
      </component>
    </v-main>
  </v-app>
</template>

<script>

export default {
  name: 'App',

  data: () => ({
    //
  })
}
</script>

<style lang="scss">
@import "@/assets/sass/app";
</style>
