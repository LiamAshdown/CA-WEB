import { SET_PROFILE_DATA_MUTATION, SET_TOAST_MESSAGE_MUTATION } from '@/store/mutation-types'
import api from '@/api/index.js'

export default {
  async getProfile (context) {
    const response = await api.profile.show()

    context.commit(SET_PROFILE_DATA_MUTATION, {
      email: response.data.email,
      firstName: response.data.firstName,
      lastName: response.data.lastName
    })
  },
  setProfile (context, payload) {
    context.commit(SET_PROFILE_DATA_MUTATION, payload)
  },
  async updateProfile (context) {
    const response = await api.profile.update(context.getters.profile)

    context.commit(SET_TOAST_MESSAGE_MUTATION, {
      message: response.message
    })
  }
}
