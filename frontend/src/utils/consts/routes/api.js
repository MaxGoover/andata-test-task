// Эндпоинты приложения
export default {
  ARTICLE: {
    CREATE: '/api/articles/create',
    GET_COMMENTS: (id) => `/api/articles/${id}/get-comments`,
    INDEX: '/api/articles',
    SHOW: (id) => `/api/articles/${id}`,
    UPDATE: '/api/articles/update',
  },
}
