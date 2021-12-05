<template>
  <v-toolbar
    fixed
    flat
    elevation="0"
    color="white"
  >
    <v-btn @click="back" icon>
      <v-icon>mdi-close</v-icon>
    </v-btn>

    <v-spacer></v-spacer>

    <v-btn
      color="primary"
      elevation="0"
      :disabled="canPost ? false : true"
      rounded
      @click="post"
    >
      Post
    </v-btn>

  </v-toolbar>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'TopPostNavigation',
  computed: {
    ...mapGetters('feed', ['canPost'])
  },
  methods: {
    post () {
      this.$store.dispatch('feed/post')

      this.$router.back()
    },
    back () {
      this.$router.back()
    }
  }
}
</script>
