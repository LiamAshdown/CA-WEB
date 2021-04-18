import api from '@/api/index.js'
import { SET_CUSTOMER_DATA_MUTATION, SET_CUSTOMERS_DATA_MUTATION, SET_TOAST_MESSAGE_MUTATION } from '@/store/mutation-types'

export default {
  async index (context) {
    const response = await api.customers.index()

    context.commit(SET_CUSTOMERS_DATA_MUTATION, response.data)
  },
  async create (context) {
    const response = await api.customers.store(context.getters.customer)

    context.commit(SET_TOAST_MESSAGE_MUTATION, {
      message: response.message
    }, { root: true })
  },
  set (context, payload) {
    context.commit(SET_CUSTOMER_DATA_MUTATION, payload)
  }
}
