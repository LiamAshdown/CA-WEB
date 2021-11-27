
import Login from '@/pages/auth/Login.vue'
import NotAuthenticatedLayout from '@/components/layouts/NotAuthenticatedLayout.vue'

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