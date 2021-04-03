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
    this.$store.watch((state) => state.misc.toast.message, (message) => {
      const toast = this.$store.getters.toast
      console.log(toast)

      this.$bvToast.toast(message, {
        title: toast.title || 'Notification',
        variant: toast.variant || 'default',
        autoHideDelay: 1500,
        appendToast: true,
        noAutoHide: toast.noAutoHide || false
      })

      // Reset Toast
      // TODO; Setting message to empty string triggers the watch again
      this.$store.dispatch('toast', {
        title: '',
        message: '',
        variant: '',
        noAutoHide: false
      })
    })
  }
}
</script>

<style lang="scss">
.root_content {
  color: $color-font;

  main {
    margin-left: 90px;
    transition: margin 0.4s ease;

    .body {
      padding: 30px 10px;
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
