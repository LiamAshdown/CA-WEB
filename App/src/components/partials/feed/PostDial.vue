<template>
  <v-speed-dial
    fixed
    v-model="fab"
    :direction="direction"
    :open-on-hover="hover"
    :transition="transition"
  >
    <template v-slot:activator>
      <v-btn
        v-model="fab"
        color="primary"
        dark
        fab
      >
        <v-icon v-if="fab">
          mdi-close
        </v-icon>
        <v-icon v-else>
          mdi-plus
        </v-icon>
      </v-btn>
    </template>
    <v-btn
      fab
      dark
      small
      color="blue"
      :to="{name: 'post'}"
    >
      <v-icon>mdi-pencil</v-icon>
    </v-btn>
  </v-speed-dial>
</template>

<script>
export default {
  name: 'PostDial',
  data () {
    return {
      direction: 'top',
      fab: false,
      hover: false,
      transition: 'slide-y-reverse-transition'
    }
  }
}
</script>

<style lang="scss" scoped>
.v-speed-dial {
  right: 15px;
  bottom: 78px;
}
</style>
