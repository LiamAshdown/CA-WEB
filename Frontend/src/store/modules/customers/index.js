import mutations from './mutations.js'
import actions from './actions.js'
import getters from './getters.js'

export default {
  namespaced: true,
  state () {
    return {
      customers: [],
      customer: {
        name: '',
        website: '',
        email: '',
        telephoneNumber: '',
        billingName: '',
        billingTelephoneNumber: '',
        billingPostalCode: '',
        billingAddress: ''
      }
    }
  },
  mutations,
  actions,
  getters
}
