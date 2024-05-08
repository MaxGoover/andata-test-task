const { configure } = require("quasar/wrappers");
const path = require("path");

module.exports = configure(function (/* ctx */) {
  return {
    boot: ["i18n", "axios"],
    css: ["app.scss"],
    extras: [
      "material-icons", // optional, you are not bound to it
      "mdi-v7",
      "roboto-font", // optional, you are not bound to it
    ],
    build: {
      target: {
        browser: ["es2019", "edge88", "firefox78", "chrome87", "safari13.1"],
        node: "node20",
      },
      vueRouterMode: "history",
      vitePlugins: [
        [
          "@intlify/vite-plugin-vue-i18n",
          {
            include: path.resolve(__dirname, "./src/i18n/**"),
          },
        ],
        [
          "vite-plugin-checker",
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
      open: true,
    },
    framework: {
      config: {},
      plugins: [],
    },
    animations: 'all',
    ssr: {
      pwa: false,
      prodPort: 3000,
      middlewares: [
        "render", // keep this as last one
      ],
    },
    pwa: {
      workboxMode: "generateSW", // or 'injectManifest'
      injectPwaMetaTags: true,
      swFilename: "sw.js",
      manifestFilename: "manifest.json",
      useCredentialsForManifestTag: false,
    },
    cordova: {},
    capacitor: {
      hideSplashscreen: true,
    },
    electron: {
      inspectPort: 5858,
      bundler: "packager", // 'packager' or 'builder'
      packager: {},
      builder: {
        appId: "andata-test-task",
      },
    },
    bex: {
      contentScripts: ["my-content-script"],
    },
  };
});
