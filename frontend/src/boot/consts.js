import { boot } from 'quasar/wrappers'
import ICONS from 'src/utils/consts/icons'

export default boot(({ app }) => {
  app.config.globalProperties.$ICONS = ICONS
})
