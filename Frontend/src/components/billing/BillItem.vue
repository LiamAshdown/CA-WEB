<template>
  <tr class="item items-group-item">
    <td colspan="4">
      <table class="w-100">
        <colgroup>
          <col style="width: 40%;">
          <col style="width: 15%;">
          <col style="width: 15%;">
          <col style="width: 10%;">
        </colgroup>
        <tbody>
          <tr>
            <td class="p-4 position-relative">
              <div class="d-flex align-items-center">
                <b-icon class="mr-4 handle" icon="arrows-move"></b-icon>
                <div class="item__selected form-control d-flex justify-content-lg-between align-items-center disabled" v-if="item.name">
                  <span>{{ item.name }}</span>
                  <font-awesome-icon icon="times" @click="deSelectItem"/>
                </div>
                <bill-item-dropdown @selectedItem="selectedItem" :passed="item.passed === false" v-else></bill-item-dropdown>
              </div>
              <div class="invalid-feedback d-block text-center position-absolute" v-if="item.passed === false"><b-icon icon="info-circle"></b-icon> Item is required</div>
            </td>
            <td class="p-4">
              <base-input
                id="quantity"
                type="number"
                :value="item.quantity"
                @input="updateField"
                :disabled="!item.name"
              ></base-input>
            </td>
            <td class="p-4">
              <base-input
                id="price"
                type="number"
                :value="item.price"
                @input="updateField"
                :disabled="!item.name"
              ></base-input>
            </td>
            <td class="text-right item__total p-4">
              <span>£ {{ calculateTotal }}</span>
              <b-icon icon="trash-fill" font-scale="1.1" @click="deleteItem" v-if="items.length > 1"></b-icon>
            </td>
          </tr>
        </tbody>
      </table>
    </td>
  </tr>
</template>

<script>
import { mapGetters } from 'vuex'
import BillItemDropdown from './BillItemDropdown.vue'

export default {
  name: 'BillItem',
  components: {
    BillItemDropdown
  },
  props: {
    index: {
      type: Number,
      required: true
    }
  },
  computed: {
    ...mapGetters({
      items: 'bills/items'
    }),
    item () {
      return this.items[this.index]
    },
    calculateTotal () {
      return (this.item.price * this.item.quantity).toLocaleString('en-GB', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      })
    }
  },
  methods: {
    updateField (value, field) {
      // TODO; I think this can be better, don't like passing an index through
      this.$store.dispatch('bills/setItem', {
        item: {
          [field]: value
        },
        index: this.index
      })
    },
    selectedItem (item) {
      this.$store.dispatch('bills/setItem', {
        item: {
          ...item,
          passed: true
        },
        index: this.index
      })
    },
    deSelectItem () {
      // Reset the item back to the default
      this.$store.dispatch('bills/setItem', {
        item: {
          name: '',
          description: '',
          quantity: 1,
          price: 0.00,
          passed: true
        },
        index: this.index
      })
    },
    deleteItem () {
      this.$store.dispatch('bills/removeItem', {
        index: this.index
      })
    }
  }
}
</script>

<style lang="scss">
.item {
  &:not(:last-child) {
    table {
      tbody {
        border: 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
      }
    }
  }

  .invalid-feedback {
    bottom: 3px;
  }

  .disabled {
    background: #eee;
  }

  &__selected {
    svg {
      &:hover {
        cursor: pointer;
      }
    }
  }

  &__total {
    svg {
      margin-left: 0.8rem;

      &:hover {
        cursor: pointer;
      }
    }
  }
}
</style>
