
// Pages
import Notifications from '@/pages/notifications/Notifications'

// Layouts
import AuthenticatedLayout from '@/components/layouts/AuthenticatedLayout'

// Middlewares
import authMiddleware from '@/router/middlewares/auth'

export default [
  {
    path: '/notifications',
    name: 'notifications',
    component: Notifications,
    meta: {
      middlewares: [
        authMiddleware
      ],
      layout: AuthenticatedLayout
    }
  }
]
