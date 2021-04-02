import api from '@/api/index.js'
import { SET_TOAST_MESSAGE_MUTATION } from '@/store/mutation-types'

export default {
  async create (context, payload) {
    const response = await api.users.store(payload)

    context.commit(SET_TOAST_MESSAGE_MUTATION, {
      message: response.message
    }, { root: true })
  }
}
