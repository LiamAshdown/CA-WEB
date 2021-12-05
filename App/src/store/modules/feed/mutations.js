import { SET_CAN_POST_MUTATION, SET_POST_MUTATION, SET_POSTS_MUTATION, LIKE_POST_MUTATION } from '@/store/mutation-types'

export default {
  [SET_CAN_POST_MUTATION] (state, payload) {
    state.post.can = payload.post
  },
  [SET_POST_MUTATION] (state, payload) {
    state.post = {
      ...state.post,
      ...payload
    }
  }
}
