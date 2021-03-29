import mutations from './mutations.js'
import actions from './actions.js'
import getters from './getters.js'

export default {
  state () {
    return {
      invoicePrefix: '',
      defaultInvoiceBody: '',
      estimatePrefix: '',
      defaultEstimateBody: ''
    }
  },
  mutations,
  actions,
  getters
}
