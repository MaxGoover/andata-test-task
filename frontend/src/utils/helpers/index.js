import { scroll } from 'quasar'
import config from 'src/utils/settings/config'

export const scrollToElement = (el) => {
  const { getScrollTarget, setVerticalScrollPosition } = scroll
  const target = getScrollTarget(el)
  setVerticalScrollPosition(target, el.offsetTop, config.debounce.scroll)
}
