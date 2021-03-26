import { SET_SIDEBAR_TOGGLE_MUTATION, SET_TOAST_MESSAGE_MUTATION } from '@/store/mutation-types'

export default {
  [SET_SIDEBAR_TOGGLE_MUTATION] (state, payload) {
    state.toggled = payload.toggled
  },
  [SET_TOAST_MESSAGE_MUTATION] (state, payload) {
    state.message = payload.message
  }
}
