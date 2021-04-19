import { SET_ESTIMATE_DATA_MUTATION, ADD_ITEM_ESTIMATES_MUTATION, REMOVE_ITEM_ESTIMATES_MUTATION, SET_ITEM_ESTIMATES_MUTATION, SET_ESTIMATE_ITEMS_DATA_MUTATION } from '@/store/mutation-types'
import api from '@/api/index.js'

export default {
  addItem ({ commit, rootGetters }, payload = null) {
    commit(ADD_ITEM_ESTIMATES_MUTATION, payload || rootGetters['items/item'])
  },
  setItem (context, payload) {
    context.commit(SET_ITEM_ESTIMATES_MUTATION, payload)
  },
  removeItem (context, payload) {
    context.commit(REMOVE_ITEM_ESTIMATES_MUTATION, payload)
  },
  setItems (context, payload) {
    context.commit(SET_ESTIMATE_ITEMS_DATA_MUTATION, payload)
  },
  async create (context) {
    const response = await api.customization.show()

    context.commit(SET_ESTIMATE_DATA_MUTATION, {
      estimateBody: response.data.defaultEstimateBody,
      prefix: response.data.estimatePrefix
    })
  },
  set (context, payload) {
    context.commit(SET_ESTIMATE_DATA_MUTATION, payload)
  }
}
