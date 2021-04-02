import { SET_PROFILE_DATA_MUTATION, SET_PROFILE_INFO_DATA_MUTATION, SET_TOAST_MESSAGE_MUTATION } from '@/store/mutation-types'
import api from '@/api/index.js'

export default {
  async getProfile (context) {
    const response = await api.profile.show()

    context.commit(SET_PROFILE_DATA_MUTATION, {
      firstName: response.data.firstName,
      lastName: response.data.lastName,
      email: response.data.email
    })
    context.commit(SET_PROFILE_INFO_DATA_MUTATION, response.data)
  },
  setProfile (context, payload) {
    context.commit(SET_PROFILE_DATA_MUTATION, payload)
  },
  async updateProfile (context) {
    const response = await api.profile.update(context.getters.profile)

    const profile = context.getters.profile
    context.commit(SET_PROFILE_INFO_DATA_MUTATION, {
      firstName: profile.firstName,
      lastName: profile.lastName
    })

    context.commit(SET_TOAST_MESSAGE_MUTATION, {
      message: response.message
    })
  }
}
