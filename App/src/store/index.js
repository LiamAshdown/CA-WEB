import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex)

const dataState = createPersistedState({
  key: 'vuex:persist',
  reducer: (state) => ({
  })
})

const store = new Vuex.Store({
  strict: true,
  modules: {},
  plugins: [dataState]
})

export default store
