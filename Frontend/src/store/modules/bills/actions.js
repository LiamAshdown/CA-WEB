import { SET_BILL_DATA_MUTATION, ADD_ITEM_BILLS_MUTATION, REMOVE_ITEM_BILLS_MUTATION, SET_ITEM_BILLS_MUTATION, SET_BILL_ITEMS_DATA_MUTATION, ADD_TAX_BILL_MUTATION, REMOVE_TAX_BILL_MUTATION, SAVE_DRAFT_MUTATION } from '@/store/mutation-types'
import api from '@/api/index.js'

export default {
  addItem ({ commit, rootGetters }, payload = null) {
    commit(ADD_ITEM_BILLS_MUTATION, payload || rootGetters['items/item'])
  },
  setItem (context, payload) {
    context.commit(SET_ITEM_BILLS_MUTATION, payload)
  },
  removeItem (context, payload) {
    context.commit(REMOVE_ITEM_BILLS_MUTATION, payload)
  },
  setItems (context, payload) {
    context.commit(SET_BILL_ITEMS_DATA_MUTATION, payload)
  },
  addTax (context, payload) {
    context.commit(ADD_TAX_BILL_MUTATION, payload)
  },
  removeTax (context, payload) {
    context.commit(REMOVE_TAX_BILL_MUTATION, payload)
  },
  saveDraft (context, payload) {
    context.commit(SAVE_DRAFT_MUTATION, payload)
  },
  reset (context) {
    context.commit(SET_BILL_DATA_MUTATION, {
      id: 0,
      uniqueId: '',
      billNumber: 1,
      customer: null,
      dueDate: new Date().toISOString().slice(0, 10),
      draft: false,
      items: [],
      prefix: '...',
      taxes: [],
      termsConditions: '',
      billBody: ''
    })

    context.commit(SAVE_DRAFT_MUTATION, {
      save: false
    })
  },
  async create (context, payload) {
    const response = await api.customization.show()

    let data = {}

    if (payload.type === 'estimate') {
      data = {
        body: response.defaultEstimateBody,
        prefix: response.estimatePrefix
      }
    } else {
      data = {
        body: response.defaultInvoiceBody,
        prefix: response.invoicePrefix
      }
    }

    data.termsConditions = response.termsConditions
    data.type = payload.type

    context.commit(SET_BILL_DATA_MUTATION, data)
  },
  async store (context) {
    await api.bill.store(context.getters.bill)
  },
  set (context, payload) {
    context.commit(SET_BILL_DATA_MUTATION, payload)
  }
}
