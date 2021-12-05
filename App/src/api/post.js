import apiClient from './client'

const PREFIX = 'post'

const URL = {
  INDEX: `${PREFIX}`,
  STORE: `${PREFIX}/store`,
  LIKE: `${PREFIX}/like`,
  UNLIKE: `${PREFIX}/unlike`,
  SHOW: `${PREFIX}/show`,
  REPLY: `${PREFIX}/reply`,
  REPLIES: `${PREFIX}/replies`,
  LIKES: `${PREFIX}/likes`
}

export default {
  async index (page) {
    const response = await apiClient.get(`${URL.INDEX}?page=${page}`).then(response => response.data.data)
    return response
  },
  async store (data) {
    const response = await apiClient.post(URL.STORE, data).then(response => response.data.data)
    return response
  },
  async like (id) {
    const response = await apiClient.post(URL.LIKE, {
      id: id
    })
    return response
  },
  async unlike (id) {
    const response = await apiClient.post(URL.UNLIKE, {
      id: id
    })
    return response
  },
  async show (id) {
    const response = await apiClient.get(URL.SHOW + '/' + id).then(response => response.data.data)
    return response
  },
  async reply (data) {
    const response = await apiClient.post(URL.REPLY, data).then(response => response.data)
    return response
  },
  async replies (id) {
    const response = await apiClient.get(URL.REPLIES + '/' + id).then(response => response.data.data)
    return response
  },
  async likes (id) {
    const response = await apiClient.get(URL.LIKES + '/' + id).then(response => response.data.data)
    return response
  }
}
