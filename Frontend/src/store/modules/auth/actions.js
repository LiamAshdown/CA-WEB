import { SET_TOKEN_MUTATION, SET_PROFILE_DATA_MUTATION } from '@/store/mutation-types'
import api from '@/api/index.js'

export default {
  async login (context, payload) {
    const response = await api.auth.login(payload)

    context.commit(SET_TOKEN_MUTATION, {
      accessToken: response.accessToken,
      expiresIn: response.expiresIn,
      refreshToken: response.refreshToken,
      authenticated: true
    })

    await context.dispatch('getProfile')
  },
  async logout (context) {
    await api.auth.logout()

    // Reset the states
    context.commit(SET_TOKEN_MUTATION, {
      accessToken: '',
      expiresIn: '',
      refreshToken: '',
      authenticated: false
    })

    context.commit(SET_PROFILE_DATA_MUTATION, {
      firstName: '',
      lastName: '',
      role: '',
      permissions: ''
    })
  },
  async register (context, payload) {
    const response = await api.auth.register(payload)

    context.commit(SET_TOKEN_MUTATION, {
      accessToken: response.accessToken,
      expiresIn: response.expiresIn,
      refreshToken: response.refreshToken,
      authenticated: true
    })
  }
}
