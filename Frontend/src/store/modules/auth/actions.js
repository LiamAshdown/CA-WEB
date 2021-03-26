import { SET_TOKEN_MUTATION } from '@/store/mutation-types'
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
  },
  async logout (context) {
    await api.auth.logout()

    context.commit(SET_TOKEN_MUTATION, {
      accessToken: '',
      expiresIn: '',
      refreshToken: '',
      authenticated: false
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
