import { SET_CUSTOMIZATION_DATA_MUTATION } from '@/store/mutation-types'

export default {
  setCustomization (context, payload) {
    context.commit(SET_CUSTOMIZATION_DATA_MUTATION, payload)
  }
}
