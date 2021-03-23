import { SET_SIDEBAR_TOGGLE_MUTATION } from '@/store/mutation-types'

export default {
  [SET_SIDEBAR_TOGGLE_MUTATION] (state, payload) {
    state.toggled = payload.toggled
  }
}
