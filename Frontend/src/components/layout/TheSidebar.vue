<template>
  <div class="sidebar" :class="{ ['sidebar--active']: toggle }">
    <div class="sidebar__logo mb-4">
      <b-img src="images/logo.svg" alt="Contactors App"></b-img>
    </div>
    <ul class="sidebar__menu">
      <li class="sidebar__item sidebar__item--active">
        <a href="#">
          <font-awesome-icon icon="tachometer-alt" size="lg"/>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="sidebar__item">
        <a href="#">
          <font-awesome-icon icon="file-invoice" size="lg"/>
          <span>Invoices</span>
        </a>
      </li>
      <li class="sidebar__item">
        <a href="#">
          <font-awesome-icon icon="file-alt" size="lg"/>
          <span>Quotes</span>
        </a>
      </li>
      <li class="sidebar__item">
        <a href="#">
          <font-awesome-icon icon="user" size="lg"/>
          <span>Profile</span>
        </a>
      </li>
    </ul>
    <div class="sidebar__toggle">
      <font-awesome-icon icon="chevron-right" size="lg" @click="onToggle"/>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      toggle: true
    }
  },
  methods: {
    onToggle () {
      this.$store.dispatch('toggle', {
        toggled: this.toggle = !this.toggle
      })
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

    &:hover {
      background-color: darken($color: $primary, $amount: 8);
      cursor: pointer;
    }

    &--active {
      background-color: darken($color: $primary, $amount: 8);
    }

    a {
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
</style>
