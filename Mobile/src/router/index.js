import { createRouter, createWebHistory } from '@ionic/vue-router';
import store from '@/store';


// Modules
import authModule from './modules/auth'

// Middleware
import middlewarePipeline from '@/router/middlewarePipeline'

const routes = [
  ...authModule
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
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