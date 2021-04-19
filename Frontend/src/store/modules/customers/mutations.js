import { SET_CUSTOMERS_DATA_MUTATION } from '@/store/mutation-types'

export default {
  [SET_CUSTOMERS_DATA_MUTATION] (state, payload) {
    state.customers = payload
  }
}
