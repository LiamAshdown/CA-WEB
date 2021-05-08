import mutations from './mutations.js'
import actions from './actions.js'
import getters from './getters.js'

export default {
  namespaced: true,
  state () {
    return {
      saveDraft: false,
      bill: {
        id: 0,
        uniqueId: '',
        type: '',
        number: 1,
        customer: null,
        dueDate: new Date().toISOString().slice(0, 10),
        draft: false,
        items: [],
        prefix: '...',
        taxes: [],
        termsConditions: '',
        body: ''
      }
    }
  },
  mutations,
  actions,
  getters
}
