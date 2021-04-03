import mutations from './mutations.js'
import actions from './actions.js'
import getters from './getters.js'

export default {
  state () {
    return {
      toggled: false,
      toast: {
        title: '',
        message: '',
        variant: '',
        noAutoHide: false
      }
    }
  },
  mutations,
  actions,
  getters
}
