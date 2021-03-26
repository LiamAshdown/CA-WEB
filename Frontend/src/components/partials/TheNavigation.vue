<template>
  <b-navbar class="topbar shadow-sm" sticky>
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
        <b-badge pill variant="primary">LA</b-badge>
        <b-nav-item-dropdown>
          <b-dropdown-item :to="{ name: 'Profile' }">Profile</b-dropdown-item>
          <b-dropdown-item href="#" @click="signOut">Sign Out</b-dropdown-item>
        </b-nav-item-dropdown>
      </div>
    </b-navbar-nav>
  </b-navbar>
</template>

<script>
export default {
  name: 'Navigation',
  methods: {
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

@keyframes slideIn {
  0% {
    transform: translateY(1rem);
    opacity: 0;
  }
  100% {
    transform:translateY(0rem);
    opacity: 1;
  }
  0% {
    transform: translateY(1rem);
    opacity: 0;
  }
}
</style>
