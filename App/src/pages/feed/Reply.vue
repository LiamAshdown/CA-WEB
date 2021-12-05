<template>
  <skeleton-reply v-if="loading"></skeleton-reply>
  <div class="reply" v-else>
    <div class="reply__post">
      <div class="reply__post__user">
        <v-avatar
          color="primary"
          size="56"
        ></v-avatar>
        <div>
          <p class="font-weight-bold mb-0">{{ post.user.fullName }}</p>
          <p class="grey--text mb-0 text-body-2">@{{ post.user.username }}</p>
        </div>
      </div>
      <div class="reply__post__content">
        <p class="text-body grey--text text--darken-1" v-if="post.parent">Replying to <span class="text-body primary--text">{{ '@' + post.parent.user.username }}</span></p>
        <p class="reply__post__content--message text-body-1 ">{{ post.message }}</p>
        <p class="reply__post__content--date text-body-2 grey--text text--darken-2">15:08 - 26 Nov 21</p>
      </div>
      <div class="reply__post__extra">
        <p class="text-body-1" @click="viewLikes"><span class="font-weight-bold">{{ post.likesCount }}</span> likes</p>
      </div>
      <div class="reply__post__actions">
        <div>
          <v-btn
            icon
            color="pink"
            @click="likePost"
          >
            <v-icon>{{ post.liked ? 'mdi-heart' : 'mdi-heart-outline' }}</v-icon>
          </v-btn>
        </div>
        <v-btn
          icon
          color="primary"
        >
          <v-icon>mdi-message-outline</v-icon>
        </v-btn>
        <v-btn
          icon
          color="green"
        >
          <v-icon>mdi-share-variant</v-icon>
        </v-btn>
      </div>
    </div>

    <div class="reply__replies">
      <div class="text-center mt-4" v-if="loadingReplies">
        <v-progress-circular
          indeterminate
          color="primary"
        ></v-progress-circular>
      </div>
      <reply
        v-for="reply in replies"
        :key="reply.id"
        :post="reply"
        @likeReply="likeReply"
      ></reply>
    </div>

    <div class="reply__reply">
      <p class="text-body-2 grey--text text--darken-2 mb-0">Replying to <span class="primary--text">@{{ post.user.username }}</span></p>
        <v-textarea
          placeholder="Write a reply..."
          auto-grow
          rows="1"
          class="reply__reply--textarea mb-4"
          v-model="reply"
          row-height="15"
          counter="140"
          :rules="rules"
        ></v-textarea>

        <v-btn
          color="primary"
          elevation="0"
          rounded
          :disabled="reply.length > 140 || reply.length < 1"
          class="reply__reply--post"
          @click="replyPost"
        >
          Reply
        </v-btn>
    </div>
  </div>
</template>

<script>
import Reply from '@/components/partials/feed/Reply'
import SkeletonReply from '@/components/partials/skeletons/Reply'

export default {
  name: 'ReplyPage',
  components: {
    Reply,
    SkeletonReply
  },
  data () {
    return {
      id: this.$route.params.id,
      rules: [v => v.length <= 140 || 'Max 140 characters'],
      reply: '',
      replies: [],
      post: {},
      loading: false,
      loadingReplies: false
    }
  },
  beforeRouteUpdate (to, from, next) {
    // Refresh page changes
    this.id = to.params.id

    this.getPost()

    next()
  },
  methods: {
    async getPost () {
      this.loading = true

      try {
        this.post = await this.$api.post.show(this.id)

        this.getReplies()
      } catch (error) {
        console.log(error)
      } finally {
        this.loading = false
      }
    },
    async getReplies () {
      this.replies = []

      this.loadingReplies = true
      this.replies = await this.$api.post.replies(this.id)
      this.loadingReplies = false
    },
    likePost () {
      try {
        if (this.post.liked) {
          this.$api.post.unlike(this.post.id)
          this.post.likesCount--
        } else {
          this.$api.post.like(this.post.id)
          this.post.likesCount++
        }

        this.post.liked = !this.post.liked
      } catch {
        if (this.post.liked) {
          this.post.liked = false
          this.post.likesCount--
        } else {
          this.post.liked = true
          this.post.likesCount++
        }
      }
    },
    likeReply (post) {
      const like = (post) => {
        this.replies = this.replies.map(reply => {
          if (post.id === reply.id) {
            reply.liked = !reply.liked

            if (reply.liked) {
              reply.likesCount++
            } else {
              reply.likesCount--
            }
          }

          return reply
        })
      }

      try {
        if (post.liked) {
          this.$api.post.unlike(post.id)
        } else {
          this.$api.post.like(post.id)
        }

        like(post)
      } catch {
        like(post)
      }
    },
    async replyPost () {
      await this.$api.post.reply({
        message: this.reply,
        id: this.id
      })

      this.reply = ''

      this.getReplies()
    },
    viewLikes () {
      this.$router.push({
        name: 'likes',
        params: {
          id: this.post.id
        }
      })
    }
  },
  mounted () {
    this.getPost()
  }
}
</script>

<style lang="scss" scoped>
.reply {
  &__post {
    &__user {
      display: flex;
      align-items: center;
      gap: 2.5%;
      padding: 15px;
    }

    &__content {
      padding: 15px;
      padding-top: 0px;
      padding-bottom: 0px;
      border-bottom: 3px solid #f3f6f7 !important;

      &--message {
        font-size: 1.3rem !important;
      }

      &--date {
        margin-bottom: 10px;
      }
    }

    &__extra {
      padding: 15px;
      padding-top: 6px;
      padding-bottom: 6px;
      border-bottom: 3px solid #f3f6f7 !important;

      p {
        margin-bottom: 0px;
      }
    }

    &__actions {
      display: flex;
      justify-content: space-evenly;
      border-bottom: 3px solid #f3f6f7 !important;
    }
  }

  &__reply {
    padding: 10px;
    position: fixed;
    bottom: 0px;
    width: 100%;
    border-top: 3px solid #f3f6f7 !important;
    background-color: white;

    &--textarea {
      max-height: 7rem;
      overflow: auto;
    }

    &--post {
      float: right;
    }
  }
}
</style>
