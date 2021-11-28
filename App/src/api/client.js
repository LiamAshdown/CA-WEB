import axios from 'axios'
import store from '@/store/index'
import { camelizeKeys, decamelizeKeys, decamelize } from 'humps'

const apiClient = axios.create({
  baseURL: 'http://backend.test/api/v1'
})

apiClient.interceptors.request.use(config => {
  const jwtToken = store.getters.accessToken
  const headers = jwtToken ? { Authorization: `Bearer ${jwtToken}` } : {}

  if (config.headers['Content-Type'] === 'application/x-www-form-urlencoded') {
    const formData = new FormData()

    for (const key in config.data) {
      // Turn null into empty string
      if (config.data[key] === null) {
        config.data[key] = ''
      }

      formData.append(decamelize(key), config.data[key])
    }

    config.data = formData
  } else {
    config.data = decamelizeKeys(config.data)
  }

  config.params = { XDEBUG_SESSION_START: 'PHPSTORM' }

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
  if (error.response.status === 422) {
    if (error.response.data) {
      error.response.data = camelizeKeys(error.response.data)
    }
  }

  return Promise.reject(error)
})

export default apiClient
