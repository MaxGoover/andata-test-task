// Эндпоинты приложения
export default {
  ARTICLE: {
    CREATE: '/api/articles',
    DELETE: (id) => `/api/articles/${id}`,
    GET_COMMENTS: (id) => `/api/articles/${id}/get-comments`,
    INDEX: '/api/articles',
    SHOW: (id) => `/api/articles/${id}`,
    UPDATE: (id) => `/api/articles/${id}`,
  },
}
