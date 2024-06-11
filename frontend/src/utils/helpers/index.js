import { scroll } from 'quasar'
import config from 'src/utils/settings/config'

// Общие вспомогательные функции приложения

/**
 * Скроллит экран до указанного DOM-элемента.
 * @param {Object} el - объект DOM-элемента
 * @returns {void}
 */
export const scrollToElement = (el) => {
  const { getScrollTarget, setVerticalScrollPosition } = scroll
  const target = getScrollTarget(el)
  setVerticalScrollPosition(target, el.offsetTop, config.debounce.scroll)
}
