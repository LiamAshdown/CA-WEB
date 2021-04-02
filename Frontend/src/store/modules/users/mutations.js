import { SET_USERS_DATA_MUTATION, SET_USER_DATA_MUTATION } from '@/store/mutation-types'

export default {
  [SET_USERS_DATA_MUTATION] (state, payload) {
    state.users = payload.users
  },
  [SET_USER_DATA_MUTATION] (state, payload) {
    for (const [key, value] of Object.entries(payload)) {
      state.user[key] = value
    }
  }
}
