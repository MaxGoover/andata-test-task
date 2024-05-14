// Настройки валидации приложения
export default {
  comment: {
    content: {
      minLength: 3,
      maxLength: 10000,
    },
    title: {
      minLength: 3,
      maxLength: 100,
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
