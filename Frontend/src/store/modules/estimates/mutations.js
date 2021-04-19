import { SET_ESTIMATE_DATA_MUTATION, ADD_ITEM_ESTIMATES_MUTATION, REMOVE_ITEM_ESTIMATES_MUTATION, SET_ITEM_ESTIMATES_MUTATION, SET_ESTIMATE_ITEMS_DATA_MUTATION } from '@/store/mutation-types'
import { uuid } from '@/helpers/utils'

export default {
  [SET_ESTIMATE_DATA_MUTATION] (state, payload) {
    for (const [key, value] of Object.entries(payload)) {
      state.estimate[key] = value
    }
  },
  [ADD_ITEM_ESTIMATES_MUTATION] (state, payload) {
    // Create random hash (used for loop key)
    payload.uniqueId = uuid()
    payload.quantity = 1

    state.estimate.items = [...state.estimate.items, { ...payload }]
  },
  [SET_ITEM_ESTIMATES_MUTATION] (state, payload) {
    for (const [key, value] of Object.entries(payload.item)) {
      state.estimate.items[payload.index][key] = value
    }
  },
  [REMOVE_ITEM_ESTIMATES_MUTATION] (state, payload) {
    state.estimate.items.splice(payload.index, 1)
  },
  [SET_ESTIMATE_ITEMS_DATA_MUTATION] (state, payload) {
    state.estimate.items = payload
  }
}
