import mutations from './mutations.js'
import actions from './actions.js'
import getters from './getters.js'

export default {
  state () {
    return {
      firstName: '',
      lastName: '',
      role: '',
      permissions: ''
    }
  },
  mutations,
  actions,
  getters
}
