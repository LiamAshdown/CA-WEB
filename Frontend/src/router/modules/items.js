// Pages
import CreateItemPage from '@/pages/items/CreateItemPage.vue'

// Layouts
import AuthenticatedLayout from '@/components/layouts/AuthenticatedLayout.vue'

// Middleware
import auth from '@/router/middleware/auth.js'

export default [
  {
    path: '/items/create',
    name: 'CreateItem',
    component: CreateItemPage,
    meta: {
      middleware: [
        auth
      ],
      layout: AuthenticatedLayout
    }
  }
]
