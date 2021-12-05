<template>
  <div>
    <template v-if="loading">
      <post-skeleton></post-skeleton>
      <post-skeleton></post-skeleton>
      <post-skeleton></post-skeleton>
    </template>
    <template v-else>
      <post
        v-for="post in posts"
        :key="post.id"
        :post="post"
        @likePost="likePost"
        @unlikePost="unlikePost"
      ></post>
    </template>
    <infinite-loading @distance="1" @infinite="getPosts">
        <div slot="spinner">
          <v-progress-circular
            indeterminate
            color="primary"
            class="mt-4"
          ></v-progress-circular>
        </div>
        <div slot="no-more">
          <p class="text-body-2 mt-4">No more posts</p>
        </div>
        <div slot="no-results"><p class="text-body-2 mt-4">We're empty</p></div>
    </infinite-loading>
  </div>
</template>

<script>
import InfiniteLoading from 'vue-infinite-loading'
import PostSkeleton from '@/components/partials/skeletons/Post'
import Post from '@/components/partials/feed/Post'

export default {
  name: 'FeedsComponent',
  components: {
    InfiniteLoading,
    Post,
    PostSkeleton
  },
  data () {
    return {
      loading: false,
      page: 1,
      posts: []
    }
  },
  methods: {
    async getPosts ($state) {
      const response = await this.$api.post.index(this.page)

      if (response.length) {
        this.page++

        for (const post of response) {
          this.posts.push(post)
        }

        $state.loaded()
      } else {
        $state.complete()
      }
    },
    likePost (id) {
      try {
        this.$api.post.like(id)

        this.posts = this.posts.map(post => {
          if (post.id === id) {
            post.liked = true
            post.likesCount++
          }

          return post
        })
      } catch (e) {
        this.posts = this.posts.map(post => {
          if (post.id === id) {
            post.liked = false
            post.likesCount--
          }

          return post
        })
      }
    },
    unlikePost (id) {
      try {
        this.$api.post.like(id)

        this.posts = this.posts.map(post => {
          if (post.id === id) {
            post.liked = false
            post.likesCount--
          }

          return post
        })
      } catch (e) {
        this.posts = this.posts.map(post => {
          if (post.id === id) {
            post.liked = true
            post.likesCount++
          }

          return post
        })
      }
    }
  },
  beforeDestroy () {
    this.$pullToRefresh.destroyAll()
  },
  async mounted () {
    const $this = this
    this.$pullToRefresh.init({
      mainElement: '.authenticated-layout',
      distReload: 120,
      distMax: 120,
      onRefresh () {
        $this.page = 1
        $this.getPosts()
      }
    })
  }
}
</script>
