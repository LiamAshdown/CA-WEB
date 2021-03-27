import { SET_COMPANY_DATA_MUTATION, SET_TOAST_MESSAGE_MUTATION } from '@/store/mutation-types'
import api from '@/api/index.js'

export default {
  async getCompany (context) {
    const response = await api.company.show()

    context.commit(SET_COMPANY_DATA_MUTATION, response.data)
  },
  setCompany (context, payload) {
    context.commit(SET_COMPANY_DATA_MUTATION, payload)
  },
  async updateCompany (context) {
    const response = await api.company.update(context.getters.company)

    context.commit(SET_TOAST_MESSAGE_MUTATION, {
      message: response.message
    })
  }
}
