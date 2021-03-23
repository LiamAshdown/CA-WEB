import { SET_PROFILE_DATA_MUTATION } from '@/store/mutation-types'
import api from '@/api/index.js'

export default {
  async getProfile (context) {
    const response = await api.profile.show()

    context.commit(SET_PROFILE_DATA_MUTATION, {
      email: response.email,
      firstName: response.firstName,
      lastName: response.lastName
    })
  },
  updateProfile (context, payload) {
    context.commit(SET_PROFILE_DATA_MUTATION, payload)
  }
}
