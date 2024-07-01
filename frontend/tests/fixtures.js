// Фикстуры для тестов
export default {
  article: {
    create: {
      authorEmail: 'maxgoover@gmail.com',
      authorUsername: 'MaxGoover',
      content: 'Тестовое содержание тестовой статьи',
      title: 'Тестовый заголовок тестовой статьи',
    },
    update: {
      authorEmail: 'another_maxgoover@gmail.com',
      authorUsername: 'AnotherMaxGoover',
      content: 'Измененное содержание тестовой статьи',
      title: 'Измененный заголовок тестовой статьи',
    },
  },
  comment: {
    create: {
      authorEmail: 'maxgoover@gmail.com',
      authorUsername: 'MaxGoover',
      content: 'Тестовое содержание тестового комментария',
      title: 'Тестовый заголовок тестового комментария',
    },
    update: {
      authorEmail: 'another_maxgoover@gmail.com',
      authorUsername: 'AnotherMaxGoover',
      content: 'Измененное содержание тестового комментария',
      title: 'Измененный заголовок тестового комментария',
    },
  },
}
