import api from '@/api/index.js'
import { SET_ITEM_DATA_MUTATION, SET_ITEMS_DATA_MUTATION, SET_ITEMS_LOADING_STATE, SET_TOAST_MESSAGE_MUTATION } from '@/store/mutation-types'

export default {
  async index (context) {
    context.commit(SET_ITEMS_LOADING_STATE, {
      loading: true
    })

    const response = await api.items.index()

    context.commit(SET_ITEMS_DATA_MUTATION, {
      items: response.data
    })

    // TODO; Maybe we can put this in SET_ITEMS_DATA_MUTATIONS?
    context.commit(SET_ITEMS_LOADING_STATE, {
      loading: false
    })
  },
  async create (context) {
    const response = await api.items.store(context.getters.item)

    // TODO; When we adding a new item, we should just push it to the array,
    // instead of just recalling the index API - I'm doing this just out of lazyiness
    await context.dispatch('index')

    context.commit(SET_TOAST_MESSAGE_MUTATION, {
      message: response.message
    }, { root: true })
  },
  set (context, payload) {
    context.commit(SET_ITEM_DATA_MUTATION, payload)
  },
  reset (context) {
    context.commit(SET_ITEM_DATA_MUTATION, {
      id: 0,
      uniqueId: '',
      name: '',
      description: '',
      net: 0.00,
      vat: 20
    })
  }
}
