import { SET_CUSTOMER_DATA_MUTATION, SET_CUSTOMERS_DATA_MUTATION } from '@/store/mutation-types'

export default {
  [SET_CUSTOMER_DATA_MUTATION] (state, payload) {
    for (const [key, value] of Object.entries(payload)) {
      state.customer[key] = value
    }
  },
  [SET_CUSTOMERS_DATA_MUTATION] (state, payload) {
    state.customers = payload
  }
}
