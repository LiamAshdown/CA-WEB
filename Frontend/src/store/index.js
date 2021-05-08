import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'

import authModule from '@/store/modules/auth/index.js'
import miscModule from '@/store/modules/misc/index.js'
import profileModule from '@/store/modules/profile/index.js'
import customersModule from '@/store/modules/customers/index.js'
import itemsModule from '@/store/modules/items/index.js'
import billsModule from '@/store/modules/bills/index.js'

Vue.use(Vuex)

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

const store = new Vuex.Store({
  strict: true,
  modules: {
    auth: authModule,
    profile: profileModule,
    misc: miscModule,
    customers: customersModule,
    items: itemsModule,
    bills: billsModule
  },
  plugins: [dataState]
})

export default store
