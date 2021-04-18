// Pages
import UsersPage from '@/pages/users/UsersPage.vue'
import AddUserPage from '@/pages/users/AddUserPage.vue'
import EditUserPage from '@/pages/users/EditUserPage.vue'

// Layouts
import AuthenticatedLayout from '@/components/layouts/AuthenticatedLayout.vue'

// Middleware
import auth from '@/router/middleware/auth.js'

export default [
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
    path: '/users/create',
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
    path: '/users/edit/:id',
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
