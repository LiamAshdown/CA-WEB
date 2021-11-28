
// Pages
import Login from '@/pages/auth/Login'
import Register from '@/pages/auth/Register'
import Company from '@/pages/auth/Company'

// Layouts
import NotAuthenticatedLayout from '@/components/layouts/NotAuthenticatedLayout'

export default [
  {
    path: '/',
    component: Register,
    meta: {
      layout: NotAuthenticatedLayout
    }
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: {
      layout: NotAuthenticatedLayout
    }
  },
  {
    path: '/register',
    name: 'register',
    component: Register,
    meta: {
      layout: NotAuthenticatedLayout
    }
  },
  {
    path: '/register/company',
    name: 'registerCompany',
    component: Company,
    meta: {
      layout: NotAuthenticatedLayout
    }
  }
]
