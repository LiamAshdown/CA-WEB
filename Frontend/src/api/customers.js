import apiClient from './client'

const PREFIX = 'customers'

const URL = {
  INDEX: `${PREFIX}`,
  STORE: `${PREFIX}/store`
}

export default {
  async index () {
    const response = await apiClient.get(URL.INDEX).then(response => response.data)
    return response
  },
  async store (payload) {
    const response = await apiClient.post(URL.STORE, payload).then(response => response.data)
    return response
  }
}
