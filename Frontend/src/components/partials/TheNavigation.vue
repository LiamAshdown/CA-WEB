<template>
  <b-navbar class="topbar shadow-sm" sticky>
    <div class="topbar__nav-icon" :class="{ ['topbar__nav-icon--open']: toggled }" @click="toggle">
      <div></div>
    </div>
    <b-navbar-nav class="ml-auto" :active="true">
      <b-nav-item-dropdown class="topbar__notification">
        <template #button-content>
          <b-badge pill variant="primary">1</b-badge>
          <font-awesome-icon icon="bell" size="lg"/>
        </template>
        <b-dropdown-item href="#">Notification 1</b-dropdown-item>
        <b-dropdown-item href="#">Notification 2</b-dropdown-item>
      </b-nav-item-dropdown>
      <div class="topbar__profile">
        <b-badge pill variant="primary">{{ initials }}</b-badge>
        <b-nav-item-dropdown>
          <b-dropdown-item :to="{ name: 'Profile' }">Profile</b-dropdown-item>
          <b-dropdown-item href="#" @click="signOut">Sign Out</b-dropdown-item>
        </b-nav-item-dropdown>
      </div>
    </b-navbar-nav>
  </b-navbar>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'Navigation',
  computed: {
    ...mapGetters(['toggled', 'initials'])
  },
  methods: {
    toggle () {
      this.$store.dispatch('toggle', {
        toggled: true
      })
    },
    async signOut () {
      await this.$store.dispatch('logout')
      this.$router.push({ name: 'SignIn' })
    }
  }
}
</script>

<style lang="scss">
.topbar {
  height: 60px;
  background-color: #fff;

  &__nav-icon {
    display: none;
    width: 30px;

    &:before {
      background-color: #777777;
      content: '';
      display: block;
      height: 2px;
      margin: 7px 0;
      transition: all .2s ease-in-out;
    }

    div,
    &:after {
      background-color: #777777;
      content: '';
      display: block;
      height: 2px;
      margin: 7px 0;
      transition: all .2s ease-in-out;
    }

    &--open {
      &:before {
        transform: translateY(9px) rotate(135deg);
      }

      &:after {
        transform: translateY(-9px) rotate(-135deg);
      }

      div {
        transform: scale(0);
      }
    }
  }

  &__notification {
    .badge {
      position: relative;
      top: -10px;
      left: 29px;
      width: 15px;
      height: 15px;
      border-radius: 25px;
      padding: .25rem .1rem;
    }

    svg {
      margin-right: 10px;
    }
  }

  &__profile {
    display: inherit;
    padding-left: 10px;
    margin-left: 10px;
    border-left: 1px solid #dee2e6;

    .badge {
      background-color: $primary;
      display: inline-block;
      margin: 5px 5px;
      width: 30px;
      height: 30px;
      text-align: center;
      line-height: 24px;
    }
  }

  .router-link-active {
    background-color: $primary;
    color: #fff;
  }

  .dropdown-menu {
    right: 0;
    left: auto;
    top: 50px;
    border-color: transparent;
    box-shadow: 0px 5px 7px -5px #00000054;
    border-radius: 0 0 5px 5px;
    animation: slideIn 0.3s ease;
  }
}

@include media-breakpoint-down(sm) {
  .topbar {
    &__nav-icon {
      display: initial;
    }
  }
}
</style>
