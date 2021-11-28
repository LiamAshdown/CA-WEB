
// Pages
import Feed from '@/pages/general/Feed'

// Layouts
import AuthenticatedLayout from '@/components/layouts/AuthenticatedLayout'

// Middlewares
import authMiddleware from '@/router/middlewares/auth'

export default [
  {
    path: '/feed',
    name: 'feed',
    component: Feed,
    meta: {
      middlewares: [
        authMiddleware
      ],
      layout: AuthenticatedLayout
    }
  }
]
