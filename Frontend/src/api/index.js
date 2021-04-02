import authApi from './auth.js'
import profileApi from './profile.js'
import companyApi from './company.js'
import usersApi from './users.js'

export const api = {
  auth: authApi,
  profile: profileApi,
  company: companyApi,
  users: usersApi
}

export default api
