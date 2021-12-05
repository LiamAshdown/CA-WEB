import { SET_CAN_POST_MUTATION, SET_POST_MUTATION } from '@/store/mutation-types'

import api from '@/api'

export default {
  canPost (context, payload) {
    context.commit(SET_CAN_POST_MUTATION, payload)
  },
  setPost (context, payload) {
    context.commit(SET_POST_MUTATION, payload)
  },
  post (context) {
    const { text } = context.state.post

    api.post.store({
      message: text
    })

    context.commit(SET_POST_MUTATION, {
      can: true,
      text: ''
    })
  }
}
