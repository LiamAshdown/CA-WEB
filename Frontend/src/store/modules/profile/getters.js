export default {
  profile (state) {
    return state
  },
  initials (state) {
    return state.info.firstName[0] + state.info.lastName[0]
  }
}
