import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'

import authModule from '@/store/modules/auth/index.js'
import miscModule from '@/store/modules/misc/index.js'
import profileModule from '@/store/modules/profile/index.js'

Vue.use(Vuex)

const dataState = createPersistedState({
  key: 'vuex:persist',
  paths: ['auth']
})

const store = new Vuex.Store({
  modules: {
    auth: authModule,
    profile: profileModule,
    misc: miscModule
  },
  plugins: [dataState]
})

export default store
