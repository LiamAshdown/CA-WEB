import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '@/store/index.js'
import LoginPage from '@/pages/auth/LoginPage.vue'
import SignUpPage from '@/pages/auth/SignUpPage.vue'
import DashboardPage from '@/pages/DashboardPage.vue'
import ProfilePage from '@/pages/ProfilePage.vue'

import middlewarePipeline from '@/router/middlewarePipeline.js'
import auth from './middleware/auth.js'

Vue.use(VueRouter)

const routes = [
  {
    path: '/login',
    name: 'SignIn',
    component: LoginPage,
    meta: {
      middleware: [
        auth
      ]
    }
  },
  {
    path: '/signup',
    name: 'SignUp',
    component: SignUpPage,
    meta: {
      auth: false
    }
  },

  {
    path: '/dashboard',
    name: 'Dashboard',
    component: DashboardPage,
    meta: {
      auth: true
    }
  },
  {
    path: '/profile',
    name: 'Profile',
    component: ProfilePage,
    meta: {
      auth: true
    }
  }
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
