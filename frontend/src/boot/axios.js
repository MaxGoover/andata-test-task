import { boot } from 'quasar/wrappers'
import { i18n } from 'boot/i18n'
import axios from 'axios'

const api = axios.create({ baseURL: 'https://api.example.com' })

// при запросе к апи, добавляем в заголовок токен пользователя, локализацию и тп.
axios.interceptors.request.use((request) => {
  request.headers['Accept-Language'] = i18n.locale
  return request
})

export default boot(({ app }) => {
  app.config.globalProperties.$axios = axios
  app.config.globalProperties.$api = api
})

export { api }
