import Vue from 'vue'
import store from '@/store'
import router from '@/router'

import App from './App.vue'
import vuetify from './plugins/vuetify'

// Api
import api from '@/api'

// Loaders
import '@/global/loaders'

Vue.prototype.$api = api

Vue.config.productionTip = false

new Vue({
  vuetify,
  store,
  router,
  render: h => h(App)
}).$mount('#app')
