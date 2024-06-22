// Общие вспомогательные функции приложения
import { scroll } from 'quasar'
import config from 'src/utils/settings/config'

/**
 * Приводит CSS-цвет из формата hex в rgb.
 * @example "#0033ff" -> rgb(0, 51, 255)
 * @param {String} hex
 * @returns {String}
 */
export const castHexToRgb = (hex) => {
  const rgb = hex
    .replace(/^#?([a-f\d])([a-f\d])([a-f\d])$/i, (m, r, g, b) => '#' + r + r + g + g + b + b)
    .substring(1)
    .match(/.{2}/g)
    .map((x) => parseInt(x, 16))
  return 'rgb(' + rgb.join(', ') + ')'
}

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
