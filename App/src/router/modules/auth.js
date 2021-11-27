
// Pages
import Login from '@/pages/auth/Login'

// Layouts
import NotAuthenticatedLayout from '@/components/layouts/NotAuthenticatedLayout'

export default [
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: {
      layout: NotAuthenticatedLayout
    }
  }
]
