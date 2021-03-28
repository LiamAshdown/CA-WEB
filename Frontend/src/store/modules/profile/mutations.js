import { SET_PROFILE_DATA_MUTATION, SET_PROFILE_INFO_DATA_MUTATION } from '@/store/mutation-types'

export default {
  [SET_PROFILE_DATA_MUTATION] (state, payload) {
    for (const [key, value] of Object.entries(payload)) {
      state[key] = value
    }
  },
  [SET_PROFILE_INFO_DATA_MUTATION] (state, payload) {
    for (const [key, value] of Object.entries(payload)) {
      state.info[key] = value
    }
  }
}
