<template>
  <div class="sidebar" :class="{ ['sidebar--active']: toggled }">
    <div class="sidebar__logo mb-4">
      <b-img src="/images/logo.svg" alt="Contactors App"></b-img>
    </div>
    <ul class="sidebar__menu">
      <router-link tag="li" class="sidebar__item" :to="{ name: 'Dashboard' }">
        <div>
          <font-awesome-icon icon="tachometer-alt" size="lg"/>
          <span>Dashboard</span>
        </div>
      </router-link>
      <!-- <router-link tag="li" class="sidebar__item" :to="{ name: 'fasdasda' }">
        <div>
          <font-awesome-icon icon="file-invoice" size="lg"/>
          <span>Invoices</span>
        </div>
      </router-link>
      <router-link tag="li" class="sidebar__item" :to="{ name: 'fsadsada' }">
        <div>
          <font-awesome-icon icon="file-alt" size="lg"/>
          <span>Quotes</span>
        </div>
      </router-link> -->
      <router-link tag="li" class="sidebar__item" :to="{ name: 'Users' }">
        <div>
          <font-awesome-icon icon="users" size="lg"/>
          <span>Users</span>
        </div>
      </router-link>
    </ul>
    <div class="sidebar__toggle">
      <font-awesome-icon icon="chevron-right" size="lg" @click="onToggle"/>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'TheSideBar',
  computed: {
    ...mapGetters(['toggled'])
  },
  methods: {
    onToggle () {
      this.$store.dispatch('toggle')
    }
  }
}
</script>

<style lang="scss">
.sidebar {
  height: 100%;
  width: 90px;
  background-color: $primary;
  position: fixed;
  transition: width 0.4s ease;
  $p: &;

  &__logo {
    display: flex;
    justify-content: center;

    img {
      height: 50px;
    }
  }

  &__menu {
    display: flex;
    justify-content: center;
    flex-direction: column;
    padding: 0px;
    margin-left: 20px;
  }

  &__item {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 50px;
    width: 50px;
    border-radius: 10px;
    margin-bottom: 10px;
    transition: background-color 0.3s ease, width 0.3s ease;
    $pItem: &;

    &:hover {
      background-color: darken($color: $primary, $amount: 8);
      cursor: pointer;
    }

    &.router-link-active {
      background-color: darken($color: $primary, $amount: 8);
    }

    div {
      display: flex;
      width: 100%;
    }

    svg {
      color: darken($color: $white, $amount: 10);
      flex: 0 0 50px;
    }

    span {
      color: #fff;
      transition: opacity 0.1s ease;
      opacity: 0;
    }
  }

  &__toggle {
    position: absolute;
    bottom: 0px;
    padding: 10px;
    width: 100%;
    text-align: right;
    background-color: darken($color: $primary, $amount: 8);

    svg {
      color: darken($color: $white, $amount: 10);
      font-size: 18px;
      transition: all 0.3s ease;
      margin-right: 25px;

      &:hover {
        cursor: pointer;
        color: #fff;
      }
    }
  }

  &--active {
    width: 250px;

    #{$p} {
      &__item {
        width: 90%;

        span {
          opacity: 1;
        }
      }

      &__toggle {
        svg {
          transform: rotate(180deg);
        }
      }
    }
  }
}

@include media-breakpoint-down(sm) {
  .sidebar {
    left: -90px;
    transition: left 0.4s ease, width 0.4s ease;
    z-index: 999;

    &--active {
      width: 100%;
      left: 0px;
    }

    &__toggle {
      display: none;
    }
  }
}
</style>
