import { SET_CUSTOMIZATION_DATA_MUTATION } from '@/store/mutation-types'

export default {
  [SET_CUSTOMIZATION_DATA_MUTATION] (state, payload) {
    for (const [key, value] of Object.entries(payload)) {
      state[key] = value
    }
  }
}
