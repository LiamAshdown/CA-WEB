import { SET_ITEM_DATA_MUTATION, SET_ITEMS_DATA_MUTATION, SET_ITEMS_LOADING_STATE } from '@/store/mutation-types'

export default {
  [SET_ITEMS_DATA_MUTATION] (state, payload) {
    state.items = payload.items
  },
  [SET_ITEM_DATA_MUTATION] (state, payload) {
    for (const [key, value] of Object.entries(payload)) {
      state.item[key] = value
    }
  },
  [SET_ITEMS_LOADING_STATE] (state, payload) {
    state.loadingItems = payload.loading
  }
}
