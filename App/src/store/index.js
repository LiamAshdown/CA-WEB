import Vue from 'vue'

import Vuex from 'vuex'

import createPersistedState from 'vuex-persistedstate'

// Modules
import authModule from '@/store/modules/auth/'
import miscModule from '@/store/modules/misc/'
import feedModule from '@/store/modules/feed/'

Vue.use(Vuex)

const dataState = createPersistedState({
  key: 'vuex:persist'
})

const store = new Vuex.Store({
  strict: true,
  modules: {
    auth: authModule,
    misc: miscModule,
    feed: feedModule
  },
  plugins: [dataState]
})

export default store
