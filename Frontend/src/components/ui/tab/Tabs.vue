<template>
  <div>
    <base-card class="mb-4">
      <ul class='tab-navigation'>
        <li v-for='(tab, index) in tabs'
          :key='tab.title'
          @click='selectTab(index)'
          class="tab-navigation__item"
          :class='{"tab-navigation__item--active": (index == selectedIndex)}'>
          <button class="tab-navigation__btn">{{ tab.title }}</button>
        </li>
      </ul>
    </base-card>
    <slot></slot>
  </div>
</template>

<script>
export default {
  name: 'Tabs',

  data () {
    return {
      selectedIndex: 0,
      tabs: []
    }
  },
  created () {
    this.tabs = this.$children
  },
  mounted () {
    // Remove base-card
    // NOTE; If you're adding more elements, use filter and only get base-tab
    // Shifting is quicker than filter as we know there's only one child we need to remove
    this.tabs.shift()

    this.selectTab(0)
  },
  methods: {
    selectTab (i) {
      this.selectedIndex = i
      this.tabs.forEach((tab, index) => {
        tab.isActive = (index === i)
      })
    }
  }
}
</script>

<style lang="scss">
.tab-navigation {
  margin: 0 ;
  padding: 0;
  list-style: none;
  &__item {
    margin-right: 10px;
    display: inline-block;
    padding-bottom: 10px;
    border-bottom: 2px solid transparent ;
    transition: border .3s ease-in-out;

    &:hover {
      border-color: $primary;
    }

    &--active {
      border-color: $primary;
    }
  }

  &__btn {
    background-color: transparent;
    color: #777;
    border: 0 none;
  }
}
</style>
