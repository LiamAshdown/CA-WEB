<template>
  <tr class="item items-group-item">
    <td colspan="4">
      <table class="w-100">
        <colgroup>
          <col style="width: 40%;">
          <col style="width: 10%;">
          <col style="width: 15%;">
          <col style="width: 15%;">
        </colgroup>
        <tbody>
          <tr>
            <td class="d-flex align-items-center p-4">
              <b-icon class="mr-4 handle" icon="arrows-move"></b-icon>
              <div class="item__selected form-control d-flex justify-content-lg-between align-items-center disabled" v-if="itemSelected">
                <span>{{ item.name }}</span>
                <font-awesome-icon icon="times" @click="deSelectItem"/>
              </div>
              <bill-item-dropdown @selectedItem="selectedItem" v-else></bill-item-dropdown>
            </td>
            <td class="p-4">
              <base-input
                id="quantity"
                type="number"
                :value="item.quantity"
                @input="updateField"
              ></base-input>
            </td>
            <td class="p-4">
              <base-input
                id="gross"
                type="number"
                :value="item.gross"
                @input="updateField"
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
  data () {
    return {
      itemSelected: false,
      vatOptions: [
        { value: '20', text: '20%' },
        { value: '5', text: '5%' },
        { value: '0', text: '0%' }
      ]
    }
  },
  computed: {
    ...mapGetters({
      items: 'estimates/items'
    }),
    item () {
      return this.items[this.index]
    },
    calculateTotal () {
      return (this.item.gross * this.item.quantity).toLocaleString()
    }
  },
  methods: {
    updateField (value, field) {
      // TODO; I think this can be better, don't like passing an index through
      this.$store.dispatch('estimates/setItem', {
        item: {
          [field]: value
        },
        index: this.index
      })
    },
    selectedItem (item) {
      this.$store.dispatch('estimates/setItem', {
        item: item,
        index: this.index
      })

      this.itemSelected = true
    },
    deSelectItem () {
      // Reset the item back to the default
      this.$store.dispatch('estimates/setItem', {
        item: {
          name: '',
          description: '',
          quantity: 1,
          net: 0.00,
          vat: 20
        },
        index: this.index
      })

      this.itemSelected = false
    },
    deleteItem () {
      this.$store.dispatch('estimates/removeItem', {
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
