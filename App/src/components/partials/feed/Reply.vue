<template>
  <v-card
    class="post"
    elevation="0"
    v-ripple
  >
    <div @click="reply">
      <div class="post__user">
        <v-avatar
          color="primary"
          size="56"
        ></v-avatar>
        <div>
          <div>
            <p class="post__user post__user--fullname font-weight-bold">{{ post.user.fullName }}</p> <p class="post__user--username grey--text text-body-2">@{{ post.user.username }}</p>
          </div>
          <p class="text-caption">Founder</p>
          <p class="text-caption">{{ post.createdAtReadable }}</p>
        </div>
      </div>
      <div class="post__content">
        <p class="text-body">{{ post.message }}</p>
      </div>
    </div>
    <div class="post__actions">
      <div>
        <v-btn
          icon
          color="pink"
          @mousedown.stop=""
          @touchstart.stop=""
          @click.stop="likePost"
        >
          <v-icon small>{{ post.liked ? 'mdi-heart' : 'mdi-heart-outline' }}</v-icon>
        </v-btn>
      <span class="text-caption grey--text text--darken-1" v-if="post.likesCount" :key="post.likesCount">{{ post.likesCount }}</span>
      </div>
      <div>
        <v-btn
          icon
          color="primary"
        >
          <v-icon small>mdi-message-outline</v-icon>
        </v-btn>
        <span class="text-caption grey--text text--darken-1" v-if="post.commentsCount" :key="post.commentsCount">{{ post.commentsCount }}</span>
      </div>
      <v-btn
        icon
        color="green"
      >
        <v-icon small>mdi-share-variant</v-icon>
      </v-btn>
    </div>
  </v-card>
</template>

<script>
export default {
  name: 'UserReply',
  props: {
    post: {
      type: Object,
      required: true
    }
  },
  methods: {
    likePost () {
      this.$emit('likeReply', this.post)
    },
    reply () {
      // Let the ripple effect play before going onto the reply page
      setTimeout(() => {
        this.$router.push({
          name: 'reply',
          params: {
            id: this.post.id
          }
        })
      }, 100)
    }
  }
}
</script>

<style lang="scss">
.post {
  width: 150px;
  border-bottom: 3px solid #f3f6f7  !important;
  width: 100%;

  &__user {
    display: flex;
    align-items: center;
    padding: 10px;
    padding-bottom: 1px;

    p {
      margin-left: 10px;
      margin-bottom: 0px;
      padding-left: 0px;
    }

    &--fullname {
      display: inline-block;
      padding: 0px;
    }

    &--username {
      display: inline-block;
      padding: 0px;
      margin: 0px !important;
    }
  }

  &__content {
    padding: 10px;
    padding-top: 0px;
    padding-bottom: 0px;

    p {
      margin-bottom: 0px;
      margin-left: 66px;
    }
  }

  &__actions {
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    padding: 5px;

    > div {
      width: 60px;
    }
  }
}

</style>
