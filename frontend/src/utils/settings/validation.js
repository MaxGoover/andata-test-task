// Настройки валидации приложения
export default {
  article: {
    content: {
      minLength: 10,
      maxLength: 10000,
    },
    title: {
      minLength: 3,
      maxLength: 200,
    },
  },
  comment: {
    content: {
      minLength: 10,
      maxLength: 10000,
    },
    title: {
      minLength: 3,
      maxLength: 200,
    },
  },
  email: {
    maxLength: 320,
  },
  username: {
    minLength: 3,
    maxLength: 100,
  },
}
