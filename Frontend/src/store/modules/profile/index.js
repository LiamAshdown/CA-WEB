import mutations from './mutations.js'
import actions from './actions.js'
import getters from './getters.js'

export default {
  state () {
    return {
      info: {
        firstName: '',
        lastName: '',
        role: '',
        permissions: ''
      },
      firstName: '',
      lastName: '',
      email: '',
      password: ''
    }
  },
  mutations,
  actions,
  getters
}
