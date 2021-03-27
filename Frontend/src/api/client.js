import axios from 'axios'
import { camelizeKeys, decamelizeKeys, decamelize } from 'humps'
import store from '@/store'

const apiClient = axios.create({
  baseURL: `${process.env.VUE_APP_BASE_URL}/api/v1`
})

apiClient.interceptors.request.use(async config => {
  const jwtToken = store.getters.accessToken
  const headers = jwtToken ? { Authorization: `Bearer ${jwtToken}` } : {}

  if (config.headers['Content-Type'] === 'application/x-www-form-urlencoded') {
    const formData = new FormData()

    for (const key in config.data) {
      // Turn Null into empty string
      if (config.data[key] === null) {
        config.data[key] = ''
      }

      formData.append(decamelize(key), config.data[key])
    }

    config.data = formData
  } else {
    config.data = decamelizeKeys(config.data)
  }

  return {
    ...config,
    headers: {
      ...config.headers,
      ...headers
    }
  }
})

apiClient.interceptors.response.use((response) => {
  if (response.data) {
    response.data = camelizeKeys(response.data)
  }

  return response
}, (error) => {
  return Promise.reject(error)
})

export default apiClient
