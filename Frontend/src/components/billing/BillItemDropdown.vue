<template>
  <div class="item-selected" v-if="bill">
    {{ item.name }} <span class="text-primary ml-5 font-weight-bold" @click="onItemClick(null)">Deselect</span>
  </div>
  <div class="item-dropdown w-100" v-click-outside="hide" v-else>
    <div class="item-dropdown__input form-control">
      <div class="item-dropdown__search_icon" @click="handleOnDropdown(true)"><b-icon icon="search"></b-icon></div>
      <input class="item-dropdown__search"  type="search" v-model="filter" @click="handleOnDropdown(true)" placeholder="Type or click to select an item"/>
      <div class="item-dropdown__caret_icon"
        @click="handleOnDropdown(!show)"
        :class="{ ['item-dropdown__caret_icon--toggle']: show }"
      >
        <b-icon icon="caret-down-fill"></b-icon>
      </div>
    </div>
    <div class="item-dropdown__menu shadow" :class="{ ['item-dropdown__menu--toggle']: show }">
      <div class="text-center mt-4 mb-3" v-if="loading">
        <b-spinner variant="primary" label="Text Centered"></b-spinner>
      </div>
      <div class="item-dropdown__submenu scrollbar">
        <div class="item-dropdown__item"
          v-for="item in filtered"
          :key="item.id"
          @click="onItemClick(item)"
        >
          {{ item.name }}
        </div>
      </div>
      <div class="item-dropdown__item item-dropdown__item--add text-primary font-weight-bold"
        v-b-modal.modal-add-item
      >
        <b-icon icon="tag-fill" size="lg"/> Add Item
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'billDropdown',

  props: {
    bill: {
      required: false,
      default: null
    }
  },
  data () {
    return {
      show: false,
      filter: ''
    }
  },
  computed: {
    ...mapGetters({
      items: 'items/items',
      loading: 'items/loadingItems'
    }),
    filtered () {
      return this.items.filter(item => {
        return item.name.toLowerCase().includes(this.filter)
      })
    }
  },
  methods: {
    handleOnDropdown (show) {
      this.show = show
    },
    hide () {
      this.show = false
    },
    onItemClick (item) {
      this.$emit('selectedItem', item)

      this.hide()
    }
  }
}
</script>

<style lang="scss" scoped>
.item-selected {
  span {
    &:hover {
      cursor: pointer;
    }
  }
}

.item-dropdown {
  position: relative;

  &__input {
    display: flex;
    justify-content: space-between;
    padding: 0;
  }

  &__caret_icon,
  &__search_icon {
    svg {
      margin: 10px;
    }
  }

  &__caret_icon {
    &:hover {
      cursor: pointer;
    }

    svg {
      transition: transform 0.3s ease;
    }

    &--toggle {
      svg {
        transform: rotate(180deg);
      }
    }
  }

  &__search {
    border: 0px;
    width: 100%;
  }

  &__menu {
    position: absolute;
    width: 100%;
    background-color: $white;
    max-height: 0px;
    overflow: hidden;
    transition: max-height 0.2s ease-out;
    z-index: 99;

    &--toggle {
      max-height: 300px;
    }
  }

  &__submenu {
    overflow: auto;
    max-height: 250px;
  }

  &__item {
    padding: 10px;

    &:hover {
      cursor: pointer;
      background-color: darken($color: $white, $amount: 3);
    }

    &--add {
      text-align: center;
      background-color: darken($color: $white, $amount: 3);

      &:hover {
        background-color: darken($color: $white, $amount: 6);
      }
    }
  }
}
</style>
