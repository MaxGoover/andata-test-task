const { configure } = require('quasar/wrappers')
const path = require('path')

module.exports = configure(function (/* ctx */) {
  return {
    boot: ['axios', 'consts', 'i18n'],
    css: ['app.sass'],
    extras: [
      'material-icons', // optional, you are not bound to it
      'mdi-v7',
      'roboto-font', // optional, you are not bound to it
    ],
    build: {
      target: {
        browser: ['es2019', 'edge88', 'firefox78', 'chrome87', 'safari13.1'],
        node: 'node20',
      },
      vueRouterMode: 'history',
      vitePlugins: [
        [
          '@intlify/vite-plugin-vue-i18n',
          {
            include: path.resolve(__dirname, './src/i18n/**'),
          },
        ],
        [
          'vite-plugin-checker',
          {
            eslint: {
              lintCommand: 'eslint "./**/*.{js,mjs,cjs,vue}"',
            },
          },
          { server: false },
        ],
      ],
    },
    devServer: {
      open: false,
    },
    framework: {
      config: {},
      plugins: ['Notify'],
    },
    animations: 'all',
  }
})
