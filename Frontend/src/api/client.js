import axios from 'axios'
import { camelizeKeys, decamelizeKeys } from 'humps'
import store from '@/store'

const apiClient = axios.create({
  baseURL: 'http://sittracker.test/api/v1'
})

apiClient.interceptors.request.use(async config => {
  const jwtToken = store.getters.accessToken
  const headers = jwtToken ? { Authorization: `Bearer ${jwtToken}` } : {}

  config.data = decamelizeKeys(config.data)

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
