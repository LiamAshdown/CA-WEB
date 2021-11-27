// Pages
import BillPage from '@/pages/CreateBillPage.vue'
import ViewBillDraftPage from '@/pages/ViewBillDraftPage.vue'

// Layouts
import ViewBillDraftLayout from '@/components/layouts/ViewBillDraftLayout.vue'
import CacheAuthenticatedLayout from '@/components/layouts/CacheAuthenticatedLayout.vue'

// Middleware
import auth from '@/router/middleware/auth.js'

export default [
  {
    path: '/bills/create/:type',
    name: 'CreateBill',
    component: BillPage,
    meta: {
      middleware: [
        auth
      ],
      layout: CacheAuthenticatedLayout,
      keepAlive: true
    }
  },
  {
    path: '/bills/draft',
    name: 'DraftBill',
    component: ViewBillDraftPage,
    meta: {
      middleware: [
        auth
      ],
      layout: ViewBillDraftLayout
    }
  }
]
