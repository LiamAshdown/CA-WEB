import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '@/store/index.js'
import LoginPage from '@/pages/auth/LoginPage.vue'
import SignUpPage from '@/pages/auth/SignUpPage.vue'
import DashboardPage from '@/pages/DashboardPage.vue'
import ProfilePage from '@/pages/ProfilePage.vue'
import UsersPage from '@/pages/UsersPage.vue'
import AddUserPage from '@/pages/AddUserPage.vue'
import EditUserPage from '@/pages/EditUserPage.vue'
import NotAuthenticatedLayout from '@/components/layouts/NotAuthenticatedLayout.vue'
import AuthenticatedLayout from '@/components/layouts/AuthenticatedLayout.vue'

import middlewarePipeline from '@/router/middlewarePipeline.js'
import auth from './middleware/auth.js'

Vue.use(VueRouter)

const routes = [
  {
    path: '/login',
    name: 'SignIn',
    component: LoginPage,
    meta: {
      layout: NotAuthenticatedLayout
    }
  },
  {
    path: '/signup',
    name: 'SignUp',
    component: SignUpPage,
    meta: {
      layout: NotAuthenticatedLayout
    }
  },

  {
    path: '/dashboard',
    name: 'Dashboard',
    component: DashboardPage,
    meta: {
      middleware: [
        auth
      ],
      layout: AuthenticatedLayout
    }
  },
  {
    path: '/profile',
    name: 'Profile',
    component: ProfilePage,
    meta: {
      middleware: [
        auth
      ],
      layout: AuthenticatedLayout
    }
  },
  {
    path: '/users',
    name: 'Users',
    component: UsersPage,
    meta: {
      middleware: [
        auth
      ],
      layout: AuthenticatedLayout
    }
  },
  {
    path: '/users/add-user',
    name: 'AddUser',
    component: AddUserPage,
    meta: {
      middleware: [
        auth
      ],
      layout: AuthenticatedLayout
    }
  },
  {
    path: '/users/edit-user/:id',
    name: 'EditUser',
    component: EditUserPage,
    meta: {
      middleware: [
        auth
      ],
      layout: AuthenticatedLayout
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
