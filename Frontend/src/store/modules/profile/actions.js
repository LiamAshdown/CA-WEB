import { SET_PROFILE_DATA_MUTATION, SET_TOAST_MESSAGE_MUTATION } from '@/store/mutation-types'
import api from '@/api/index.js'

export default {
  async getProfile (context) {
    const response = await api.profile.show()
    context.commit(SET_PROFILE_DATA_MUTATION, response)
    return response
  },
  setProfile (context, payload) {
    context.commit(SET_PROFILE_DATA_MUTATION, payload)
  },
  async updateProfile (context, payload) {
    const response = await api.profile.update(payload)

    context.commit(SET_PROFILE_DATA_MUTATION, {
      firstName: payload.firstName,
      lastName: payload.lastName
    })

    context.commit(SET_TOAST_MESSAGE_MUTATION, {
      message: response.message
    })
  }
}
