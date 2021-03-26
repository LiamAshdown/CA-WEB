import { SET_COMPANY_DATA_MUTATION, SET_TOAST_MESSAGE_MUTATION } from '@/store/mutation-types'
import api from '@/api/index.js'

export default {
  async getCompany (context) {
    const response = await api.company.show()

    context.commit(SET_COMPANY_DATA_MUTATION, {
      name: response.data.name,
      telephoneNumber: response.data.telephoneNumber,
      postalCode: response.data.postalCode,
      address: response.data.address
    })
  },
  setCompany (context, payload) {
    context.commit(SET_COMPANY_DATA_MUTATION, payload)
  },
  async updateCompany (context) {
    console.log(context.getters.company)
    const response = await api.company.update(context.getters.company)

    context.commit(SET_TOAST_MESSAGE_MUTATION, {
      message: response.message
    })
  }
}
