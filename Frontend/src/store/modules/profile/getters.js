export default {
  profile (state) {
    return state
  },
  initials (state) {
    return state.firstName[0] + state.lastName[0]
  },
  permissions (state) {
    return state.permissions
  }
}
