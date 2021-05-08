import { SET_SIDEBAR_TOGGLE_MUTATION, SET_TOAST_MESSAGE_MUTATION, SET_TOOLTIP_SEEN_MUTATION } from '@/store/mutation-types'

export default {
  toggle (context, payload) {
    context.commit(SET_SIDEBAR_TOGGLE_MUTATION, {
      toggled: !context.getters.toggled
    })
  },
  toast (context, payload) {
    context.commit(SET_TOAST_MESSAGE_MUTATION, payload)
  },
  setTooltipSeen (context, payload) {
    context.commit(SET_TOOLTIP_SEEN_MUTATION, payload)
  }
}
