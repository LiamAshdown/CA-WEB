<template>
  <div ref="app" class="root_content" :class="{ ['root_content--toggled']: toggled }">
    <the-sidebar></the-sidebar>
    <main>
      <the-navigation></the-navigation>
      <div class="body">
        <router-view></router-view>
      </div>
    </main>
  </div>
</template>

<script>
import TheNavigation from '@/components/layout/TheNavigation.vue'
import TheSidebar from '@/components/layout/TheSidebar.vue'

export default {
  name: 'App',
  components: {
    TheNavigation,
    TheSidebar
  },
  computed: {
    toggled () {
      return this.$store.getters.toggled
    }
  }
}
</script>

<style lang="scss">
.root_content {
  height: 100%;

  main {
    height: 100%;
    margin-left: 90px;
    transition: margin 0.4s ease;

    .body {
      margin: 30px;
    }
  }

  &--toggled {
    main {
      margin-left: 250px;
    }
  }
}

</style>
