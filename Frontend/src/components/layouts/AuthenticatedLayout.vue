<template>
  <div class="root_content" :class="{ ['root_content--toggled']: toggled }">
    <the-sidebar></the-sidebar>
    <main>
      <the-navigation></the-navigation>
      <div class="body">
        <slot></slot>
      </div>
    </main>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import TheNavigation from '@/components/partials/TheNavigation.vue'
import TheSidebar from '@/components/partials/TheSidebar.vue'

export default {
  name: 'AuthenticatedLayout',
  components: {
    TheNavigation,
    TheSidebar
  },
  computed: {
    ...mapGetters(['toggled'])
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
  main {
    margin-left: 90px;
    transition: margin 0.4s ease;

    .body {
      padding: 30px;
    }
  }

  &--toggled {
    main {
      margin-left: 250px;
    }
  }
}

@include media-breakpoint-down(sm) {
  .root_content {
    main {
      margin: 0px;

      .body {
        padding: 30px 0px;
      }
    }
  }
}
</style>
