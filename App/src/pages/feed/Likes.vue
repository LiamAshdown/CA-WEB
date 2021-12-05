<template>
  <div class="likes">
    <like v-for="like in likes"
      :key="like.id"
      :like="like"
    />

    <div class="likes__loading" v-if="loading">
      <v-progress-circular
        indeterminate
        color="primary"
        class="mt-4"
      ></v-progress-circular>
    </div>

    <template v-else-if="likes.length === 0">
      <div class="likes__empty">
        <p class="text-body-1 mt-4">No likes yet!</p>
      </div>
    </template>
  </div>
</template>

<script>
import Like from '@/components/partials/feed/Like'

export default {
  name: 'LikesPage',

  components: {
    Like
  },
  data () {
    return {
      id: this.$route.params.id,
      likes: [],
      loading: false
    }
  },
  methods: {
    async getLikes () {
      this.loading = true
      this.likes = await this.$api.post.likes(this.id)
      this.loading = false
    }
  },
  mounted () {
    this.getLikes()
  }
}
</script>

<style lang="scss" scoped>
.likes {

  &__loading,
  &__empty {
    display: flex;
    align-items: center;
    justify-content: center;
  }
}
</style>
