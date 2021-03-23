export default function ({ next, store }) {
  const isAuthenticated = store.getters.isAuthenticated
  if (to.matched.some(record => record.meta.auth !== isAuthenticated)) {
    if (!isAuthenticated) {
      next({ name: 'SignIn' })
      return
    } else {
      next({ name: 'Dashboard' })
      return
    }
  }
}