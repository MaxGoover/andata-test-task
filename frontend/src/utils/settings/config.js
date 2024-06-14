// Настройки приложения
export default {
  debounce: {
    scroll: 500,
  },
  editor: {
    maxHeight: '190px',
    toolbar: [
      ['left', 'center', 'right', 'justify'],
      ['bold', 'italic', 'strike', 'underline'],
      [
        {
          label: 'Formatting',
          icon: 'mdi-format-size',
          list: 'no-icons',
          options: ['p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'code'],
        },
        'removeFormat',
      ],
      ['undo', 'redo'],
    ],
  },
  messenger: {
    link: {
      telegram: 'https://t.me/maxgoover',
      whatsapp: 'https://wa.me/9032619316',
    },
  },
}
