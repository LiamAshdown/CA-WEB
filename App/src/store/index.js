import Vue from 'vue'

import Vuex from 'vuex'

import createPersistedState from 'vuex-persistedstate'

// Modules
import authModule from '@/store/modules/auth/index.js'

Vue.use(Vuex)

const dataState = createPersistedState({
  key: 'vuex:persist'
})

const store = new Vuex.Store({
  strict: true,
  modules: {
    auth: authModule
  },
  plugins: [dataState]
})

export default store
