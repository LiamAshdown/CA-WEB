<template>
  <div class="content shadow-sm">
    <slot></slot>
  </div>
</template>

<script>
export default {
  name: 'BaseCard'
}
</script>

<style lang="scss">
.content {
  background-color: #fff;
  padding: 30px;
  border-radius: 5px;
}
</style>
