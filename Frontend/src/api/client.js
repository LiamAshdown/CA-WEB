import axios from 'axios'
import store from '@/store'
import { camelizeKeys, decamelizeKeys, decamelize } from 'humps'

const apiClient = axios.create({
  baseURL: `${process.env.VUE_APP_BASE_URL}/api/v1`
})

apiClient.interceptors.request.use(async config => {
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
  if (!error.response) {
    store.dispatch('toast', {
      title: 'Network Error',
      message: 'Please check your internet connection or wait until servers are back online',
      variant: 'danger',
      noAutoHide: true
    })
  } else if (
    error.response.data &&
    (error.response.statusText === 'Unauthorized' ||
      error.response.data === ' Unauthorized.')
  ) {
    store.dispatch('toast', {
      title: 'Unauthorized',
      message: error.response.data.message ? error.response.data.message : 'Unauthorized',
      variant: 'danger'
    })

    store.dispatch('logout')
  } else if (error.response.status === 500) {
    store.dispatch('toast', {
      title: 'Server Error',
      message: 'An internal error server occured. Please try again later',
      variant: 'danger'
    })
  }

  return Promise.reject(error)
})

export default apiClient
