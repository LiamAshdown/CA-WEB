<template>
  <div>
    <top-reply></top-reply>
    <main class="reply-layout">
      <slot></slot>
    </main>
  </div>
</template>

<script>
import TopReply from '@/components/partials/navigation/TopReply'

export default {
  name: 'ReplyLayout',
  components: {
    TopReply
  }
}
</script>

<style lang="scss">
.reply-layout {
  margin-top: 56px;
}
</style>
