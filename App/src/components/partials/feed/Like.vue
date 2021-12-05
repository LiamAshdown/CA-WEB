<template>
  <div>
    <div class="like__user">
      <v-avatar
        color="primary"
        size="56"
      ></v-avatar>
      <div>
        <div>
          <p class="like__user like__user--fullname font-weight-bold">{{ like.user.fullName }}</p> <p class="like__user--username grey--text text-body-2">@{{ like.user.username }}</p>
        </div>
        <p class="text-caption">Founder</p>
        <p class="text-caption">{{ like.createdAtReadable }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'LikeUser',
  props: {
    like: {
      type: Object,
      required: true
    }
  }
}
</script>

<style lang="scss">
.like {
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
}
</style>
