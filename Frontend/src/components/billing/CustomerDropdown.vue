<template>
  <div class="customer-selected" v-if="customer">
    {{ customer.name }} <span class="text-primary ml-5 font-weight-bold" @click="onCustomerClick(null)">Deselect</span>
  </div>
  <div class="customer-dropdown" v-click-outside="hide" v-else>
    <div class="customer-dropdown__input form-control" :class="{['customer-dropdown--invalid']: !validated}">
      <div class="customer-dropdown__search_icon" @click="handleOnDropdown(true)"><b-icon icon="search"></b-icon></div>
      <input class="customer-dropdown__search" placeholder="Type or click to select a customer" v-model="filter" @click="handleOnDropdown(true)"/>
      <div class="customer-dropdown__caret_icon"
        @click="handleOnDropdown(!show)"
        :class="{['customer-dropdown__caret_icon--toggle']: show}"
      >
        <b-icon icon="caret-down-fill"></b-icon>
      </div>
    </div>
    <div class="customer-dropdown__menu shadow-sm" :class="{['customer-dropdown__menu--toggle']: show}">
      <template v-if="filtered.length">
        <div class="customer-dropdown__item"
          v-for="customer in filtered"
          :key="customer.id"
          @click="onCustomerClick(customer)"
        >
          {{ customer.name }}
        </div>
      </template>
      <p class="text-center pt-3" v-else>No results found...</p>
      <div class="customer-dropdown__item customer-dropdown__item--add text-primary font-weight-bold"
        v-b-modal.modal-add-customer
      >
        <font-awesome-icon icon="user-plus" size="lg"/> Add Customer
      </div>
    </div>
    <div class="invalid-feedback d-block" v-if="!validated"><b-icon icon="info-circle"></b-icon> Customer is required</div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'CustomerDropdown',

  props: {
    customer: {
      required: true
    },
    validated: {
      type: Boolean,
      required: false,
      default: true
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
      customers: 'customers/customers'
    }),
    filtered () {
      return this.customers.filter(customer => {
        return customer.name.toLowerCase().includes(this.filter)
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
    onCustomerClick (customer) {
      this.$emit('selectedCustomer', customer)

      this.hide()
    }
  },
  created () {
    this.$store.dispatch('customers/index')
  }
}
</script>

<style lang="scss" scoped>
.customer-selected {
  span {
    &:hover {
      cursor: pointer;
    }
  }
}

.customer-dropdown {
  position: relative;

  &--invalid {
    border-color: #dc3545;
  }

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
      max-height: 250px;
    }
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
    }
  }
}
</style>
