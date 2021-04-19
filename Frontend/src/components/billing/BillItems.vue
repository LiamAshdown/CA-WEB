<template>
  <base-card class="items" :padding="false">
    <div class="items__body">
      <table class="items__table w-100">
        <colgroup>
          <col style="width: 40%;">
          <col style="width: 10%;">
          <col style="width: 15%;">
          <col style="width: 15%;">
        </colgroup>
        <thead class="items__header">
          <th class="px-4">Items</th>
          <th class="text-right px-4">Quantity</th>
          <th class="px-4">Price</th>
          <th class="text-right px-4"><span>Total</span></th>
        </thead>
        <draggable
            v-model="itemsList"
            class="items__content items-group"
            v-bind="dragOptions"
            tag="tbody"
            handle=".handle"
            @start="drag=true"
            @end="drag=false"
          >
            <bill-item
              v-for="(item, index) in items"
              :key="item.uniqueId"
              :index="index"
            ></bill-item>
        </draggable>
      </table>
    </div>
    <div class="items__add text-primary font-weight-bold" @click="addLine">
      <b-icon icon="basket3-fill"></b-icon> Add An Item
    </div>
  </base-card>
</template>

<script>
import { mapGetters } from 'vuex'
import BillAddItem from './BillAddItem.vue'
import BillItem from './BillItem.vue'
import draggable from 'vuedraggable'

export default {
  name: 'BillItems',
  components: {
    BillItem,
    BillAddItem,
    draggable
  },
  data () {
    return {
      dragging: false,
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
    newEstimate () {
      return !this.addNew && !this.items.length
    },
    itemsList: {
      get () {
        return this.items
      },
      set (value) {
        // Set the new order
        this.$store.dispatch('estimates/setItems', value)
      }
    },
    dragOptions () {
      return {
        animation: 200,
        disabled: false,
        ghostClass: 'ghost'
      }
    }
  },
  methods: {
    updateState (field, value) {
      this[field] = value
    },
    addLine () {
      this.$store.dispatch('estimates/addItem', {
        name: '',
        description: '',
        gross: 0.00,
        vat: 20,
        quantity: 1
      })
    }
  },
  created () {
    // Add a new line
    this.addLine()

    // Fetch our items
    this.$store.dispatch('items/index')
  }
}
</script>

<style lang="scss">
.ghost {
  opacity: 0.5;
  background: darken($color: $white, $amount: 2)
}

.items {
  &__header {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);

    th {
      &:last-child {
        span {
          margin-right: 2.5rem;
        }
      }

      padding-bottom: .75rem;
    }
  }

  .handle {
    &:hover {
      cursor: pointer;
    }
  }

  &__body {
    padding: 1.25rem;
  }

  &__content {
    margin-top: 10px;
  }

  &__add {
    padding: 10px;
    text-align: center;
    background-color: darken($color: $white, $amount: 3);

    &:hover {
      cursor: pointer;
      background-color: darken($color: $white, $amount: 3);
    }
  }
}
</style>
