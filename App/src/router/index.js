import Vue from 'vue'
import VueRouter from 'vue-router'

import store from '@/store'

// Modules
import authModule from '@/router/modules/auth'
import generalModule from '@/router/modules/general'
import profileModule from '@/router/modules/profile'

// Middleware Pipeline
import middlewarePipeline from '@/router/middlewarePipeline.js'

Vue.use(VueRouter)

const routes = [
  ...authModule,
  ...generalModule,
  ...profileModule
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
  if (!to.meta.middleware) {
    return next()
  }

  const middleware = to.meta.middleware

  const context = {
    to,
    from,
    next,
    store
  }

  return middleware[0]({
    ...context,
    next: middlewarePipeline(context, middleware, 1)
  })
})

export default router
