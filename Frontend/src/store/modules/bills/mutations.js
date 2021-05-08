import { SET_BILL_DATA_MUTATION, ADD_ITEM_BILLS_MUTATION, REMOVE_ITEM_BILLS_MUTATION, SET_ITEM_BILLS_MUTATION, SET_BILL_ITEMS_DATA_MUTATION, ADD_TAX_BILL_MUTATION, REMOVE_TAX_BILL_MUTATION, SAVE_DRAFT_MUTATION } from '@/store/mutation-types'
import { uuid } from '@/helpers/utils'

export default {
  [SET_BILL_DATA_MUTATION] (state, payload) {
    for (const [key, value] of Object.entries(payload)) {
      state.bill[key] = value
    }
  },
  [ADD_ITEM_BILLS_MUTATION] (state, payload) {
    // Create random hash (used for loop key)
    payload.uniqueId = uuid()
    payload.quantity = 1

    state.bill.items = [...state.bill.items, { ...payload }]
  },
  [SET_ITEM_BILLS_MUTATION] (state, payload) {
    for (const [key, value] of Object.entries(payload.item)) {
      state.bill.items[payload.index][key] = value
    }
  },
  [REMOVE_ITEM_BILLS_MUTATION] (state, payload) {
    state.bill.items.splice(payload.index, 1)
  },
  [SET_BILL_ITEMS_DATA_MUTATION] (state, payload) {
    state.bill.items = payload
  },
  [ADD_TAX_BILL_MUTATION] (state, payload) {
    payload.uniqueId = uuid()
    state.bill.taxes = [...state.bill.taxes, { ...payload }]
  },
  [REMOVE_TAX_BILL_MUTATION] (state, payload) {
    state.bill.taxes.splice(payload.index, 1)
  },
  [SAVE_DRAFT_MUTATION] (state, payload) {
    state.saveDraft = payload.save
  }
}
