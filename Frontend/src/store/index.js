import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'

import authModule from '@/store/modules/auth/index.js'
import miscModule from '@/store/modules/misc/index.js'
import profileModule from '@/store/modules/profile/index.js'
import companyModule from '@/store/modules/company/index.js'

Vue.use(Vuex)

const dataState = createPersistedState({
  key: 'vuex:persist',
  reducer: (state) => ({
    auth: state.auth,
    profile: {
      firstName: state.profile.firstName,
      lastName: state.profile.lastName,
      email: state.profile.email,
      role: state.profile.role,
      permissions: state.profile.permissions
    }
  })
})

const store = new Vuex.Store({
  modules: {
    auth: authModule,
    profile: profileModule,
    company: companyModule,
    misc: miscModule
  },
  plugins: [dataState]
})

export default store
