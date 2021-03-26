import { SET_SIDEBAR_TOGGLE_MUTATION, SET_TOAST_MESSAGE_MUTATION } from '@/store/mutation-types'

export default {
  toggle (context, payload) {
    context.commit(SET_SIDEBAR_TOGGLE_MUTATION, {
      toggled: payload.toggled
    })
  },
  toast (context, payload) {
    context.commit(SET_TOAST_MESSAGE_MUTATION, {
      message: payload.message
    })
  }
}
