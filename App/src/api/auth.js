import apiClient from './client'

const PREFIX = 'auth'

const URL = {
  LOGIN: `${PREFIX}/login`,
  LOGOUT: `${PREFIX}/logout`,
  REGISTER_USER: `${PREFIX}/register/user`,
  REGISTER_COMPANY: `${PREFIX}/register/company`
}

export default {
  async login (payload) {
    const response = await apiClient.post(URL.LOGIN, payload).then(response => response.data)
    return response
  },
  async logout () {
    await apiClient.get(URL.LOGOUT)
  },
  async registerUser (payload) {
    const response = await apiClient.post(URL.REGISTER_USER, payload).then(response => response.data)
    return response
  },
  async registerCompany (payload) {
    const response = await apiClient.post(URL.REGISTER_COMPANY, payload).then(response => response.data)
    return response
  }
}
