import api from '@/api/index.js'
import { SET_CUSTOMERS_DATA_MUTATION } from '@/store/mutation-types'

export default {
  async index (context) {
    const response = await api.customers.index()

    context.commit(SET_CUSTOMERS_DATA_MUTATION, response)
  }
}
