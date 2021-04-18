import authApi from './auth.js'
import profileApi from './profile.js'
import companyApi from './company.js'
import usersApi from './users.js'
import customersApi from './customers.js'
import itemsApi from './items.js'
import customizationApi from './customization.js'

export const api = {
  auth: authApi,
  profile: profileApi,
  company: companyApi,
  users: usersApi,
  customers: customersApi,
  items: itemsApi,
  customization: customizationApi
}

export default api
