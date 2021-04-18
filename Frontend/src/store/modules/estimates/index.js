import mutations from './mutations.js'
import actions from './actions.js'
import getters from './getters.js'

export default {
  namespaced: true,
  state () {
    return {
      estimate: {
        id: 0,
        uniqueId: '',
        estimateNumber: 1,
        dueDate: '',
        draft: false,
        items: [],
        prefix: '...',
        termsConditions: '',
        estimateBody: ''
      }
    }
  },
  mutations,
  actions,
  getters
}
