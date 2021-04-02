import api from '@/api/index.js'
import { SET_USERS_DATA_MUTATION, SET_USER_DATA_MUTATION, SET_TOAST_MESSAGE_MUTATION } from '@/store/mutation-types'
import { snakeCase } from '@/utils'

export default {
  async index (context) {
    const response = await api.users.index()

    context.commit(SET_USERS_DATA_MUTATION, {
      users: response.data
    })
  },
  async show (context, payload) {
    const response = await api.users.show(payload.id)

    response.data.role = snakeCase(response.data.role)

    context.commit(SET_USER_DATA_MUTATION, response.data)
  },
  async update (context) {
    const response = await api.users.update(context.getters.user)

    context.commit(SET_TOAST_MESSAGE_MUTATION, {
      message: response.message
    }, { root: true })
  },
  async create (context, payload) {
    const response = await api.users.store(payload)

    context.commit(SET_TOAST_MESSAGE_MUTATION, {
      message: response.message
    }, { root: true })
  },
  set (context, payload) {
    context.commit(SET_USER_DATA_MUTATION, payload)
  }
}
