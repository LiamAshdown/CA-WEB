<template>
  <div class="root_content" :class="{ ['root_content--toggled']: toggled }">
    <the-sidebar v-show="authenticated"></the-sidebar>
    <main>
      <the-navigation v-show="authenticated"></the-navigation>
      <div class="body">
        <slot></slot>
      </div>
    </main>
  </div>
</template>

<script>
import TheNavigation from '@/components/partials/TheNavigation.vue'
import TheSidebar from '@/components/partials/TheSidebar.vue'

export default {
  name: 'AuthenticatedLayout',
  components: {
    TheNavigation,
    TheSidebar
  },
  computed: {
    toggled () {
      return this.$store.getters.toggled
    },
    authenticated () {
      return this.$store.getters.isAuthenticated
    }
  },
  created () {
    this.$store.watch((state) => state.misc.message, (message) => {
      this.$bvToast.toast(message, {
        title: 'Notification',
        autoHideDelay: 1500,
        appendToast: true
      })

      // Reset Toast
      this.$store.dispatch('toast', {
        message: ''
      })
    })
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
