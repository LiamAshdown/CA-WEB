import { SET_SIDEBAR_TOGGLE_MUTATION, SET_TOAST_MESSAGE_MUTATION, SET_TOOLTIP_SEEN_MUTATION } from '@/store/mutation-types'

export default {
  [SET_SIDEBAR_TOGGLE_MUTATION] (state, payload) {
    state.toggled = payload.toggled
  },
  [SET_TOAST_MESSAGE_MUTATION] (state, payload) {
    state.toast = payload
  },
  [SET_TOOLTIP_SEEN_MUTATION] (state, payload) {
    state.tooltips.seen = [...state.tooltips.seen, payload.tooltip]
  }
}
