import mutations from './mutations.js'
import actions from './actions.js'
import getters from './getters.js'

export default {
  namespaced: true,
  state () {
    return {
      loadingItems: false,
      items: [],
      item: {
        id: 0,
        name: '',
        description: '',
        vat: 0.00,
        unitPrice: 0.00,
        net: 0.00,
        gross: 0.00
      }
    }
  },
  mutations,
  actions,
  getters
}
