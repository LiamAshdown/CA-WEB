import { SET_CUSTOMIZATION_DATA_MUTATION, SET_TOAST_MESSAGE_MUTATION } from '@/store/mutation-types'
import api from '@/api/index.js'

export default {
  async show (context) {
    const response = await api.customization.show()

    context.commit(SET_CUSTOMIZATION_DATA_MUTATION, response.data)
  },
  async update (context) {
    const response = await api.customization.update(context.getters.customization)

    context.commit(SET_TOAST_MESSAGE_MUTATION, {
      message: response.message
    }, { root: true })
  },
  set (context, payload) {
    context.commit(SET_CUSTOMIZATION_DATA_MUTATION, payload)
  }
}
