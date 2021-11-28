
// Pages
import Profile from '@/pages/profile/Profile'

// Layouts
import AuthenticatedLayout from '@/components/layouts/AuthenticatedLayout'

// Middlewares
import authMiddleware from '@/router/middlewares/auth'

export default [
  {
    path: '/profile',
    name: 'profile',
    component: Profile,
    meta: {
      middlewares: [
        authMiddleware
      ],
      layout: AuthenticatedLayout
    }
  }
]
