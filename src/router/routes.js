const routes = [
  // Главная страница
  {
    path: '/',
    component: () => import('layouts/LayoutBlog.vue'),
    children: [
      {
        path: '',
        redirect: 'articles',
      },
    ],
  },

  // Статьи
  {
    path: '/articles',
    component: () => import('layouts/LayoutBlog.vue'),
    children: [
      { path: '', component: () => import('pages/articles/PageArticlesIndex.vue') },
      {
        path: ':id',
        name: 'ArticlesShow',
        component: () => import('pages/articles/PageArticlesShow.vue'),
      },
    ],
  },

  // Ошибка
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue'),
  },
]

export default routes
