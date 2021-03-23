import { SET_SIDEBAR_TOGGLE_MUTATION } from '@/store/mutation-types'

export default {
  toggle (context, payload) {
    context.commit(SET_SIDEBAR_TOGGLE_MUTATION, {
      toggled: payload.toggled
    })
  }
}
