
// Pages
import Feed from '@/pages/feed/Feed'
import Post from '@/pages/feed/Post'
import Reply from '@/pages/feed/Reply'
import Likes from '@/pages/feed/Likes'

// Layouts
import AuthenticatedLayout from '@/components/layouts/AuthenticatedLayout'
import PostLayout from '@/components/layouts/PostLayout'
import ReplyLayout from '@/components/layouts/ReplyLayout'
import LikesLayout from '@/components/layouts/LikesLayout'

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
  },
  {
    path: '/post',
    name: 'post',
    component: Post,
    meta: {
      middlewares: [
        authMiddleware
      ],
      layout: PostLayout
    }
  },
  {
    path: '/post/reply/:id',
    name: 'reply',
    component: Reply,
    meta: {
      middlewares: [
        authMiddleware
      ],
      layout: ReplyLayout
    }
  },
  {
    path: '/post/likes/:id',
    name: 'likes',
    component: Likes,
    meta: {
      middlewares: [
        authMiddleware
      ],
      layout: LikesLayout
    }
  }
]
