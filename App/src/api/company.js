import apiClient from './client'

const PREFIX = 'company'

const URL = {
  SHOW: `${PREFIX}`,
  UPDATE: `${PREFIX}/update`
}

export default {
  async show () {
    const response = await apiClient.get(URL.SHOW).then(response => response.data.data)
    return response
  },
  async update (payload) {
    const response = await apiClient.post(URL.UPDATE, payload, {
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }
    }).then(response => response.data)
    return response
  }
}
