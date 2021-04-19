import apiClient from './client'

const PREFIX = 'users'

const URL = {
  INDEX: `${PREFIX}`,
  SHOW: `${PREFIX}/show/`,
  UPDATE: `${PREFIX}/update/`,
  STORE: `${PREFIX}/store`
}

export default {
  async index () {
    const response = await apiClient.get(URL.INDEX).then(response => response.data.data)
    return response
  },
  async show (id) {
    const response = await apiClient.get(URL.SHOW + id).then(response => response.data.data)
    return response
  },
  async update (payload) {
    const response = await apiClient.post(URL.UPDATE + payload.id, payload).then(response => response.data)
    return response
  },
  async store (payload) {
    const response = await apiClient.post(URL.STORE, payload).then(response => response.data)
    return response
  }
}
