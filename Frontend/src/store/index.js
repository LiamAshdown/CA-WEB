import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'

import authModule from '@/store/modules/auth/index.js'
import miscModule from '@/store/modules/misc/index.js'
import profileModule from '@/store/modules/profile/index.js'
import companyModule from '@/store/modules/company/index.js'
import customizationModule from '@/store/modules/customization/index.js'
import usersModule from '@/store/modules/users/index.js'

Vue.use(Vuex)

const dataState = createPersistedState({
  key: 'vuex:persist',
  reducer: (state) => ({
    auth: state.auth,
    profile: {
      info: {
        firstName: state.profile.info.firstName,
        lastName: state.profile.info.lastName,
        role: state.profile.info.role,
        permissions: state.profile.info.permissions
      }
    }
  })
})

const store = new Vuex.Store({
  modules: {
    auth: authModule,
    profile: profileModule,
    company: companyModule,
    misc: miscModule,
    customization: customizationModule,
    users: usersModule
  },
  plugins: [dataState]
})

export default store
