import { createStore } from 'vuex'

import createPersistedState from 'vuex-persistedstate'

const dataState = createPersistedState({
  key: 'vuex:persist',
  reducer: (state) => ({
    auth: state.auth,
    profile: {
      firstName: state.profile.firstName,
      lastName: state.profile.lastName,
      role: state.profile.role,
      permissions: state.profile.permissions
    },
    bills: {
      bill: state.bills.bill
    }
  })
})

const store = createStore({
  strict: true,
  modules: {
  },
  plugins: [dataState]
})

export default store
