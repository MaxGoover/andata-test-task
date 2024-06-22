// Настройки всплывающих уведомлений-тостов
import { $t } from 'boot/i18n'
import { Notify } from 'quasar'

export default {
  error: (message) => {
    return Notify.create({
      badgeColor: 'yellow',
      badgeTextColor: 'black',
      closeBtn: $t('action.close'),
      message,
      multiLine: true,
      position: 'bottom',
      type: 'negative',
    })
  },
  info: (message) => {
    return Notify.create({
      badgeColor: 'yellow',
      badgeTextColor: 'black',
      closeBtn: $t('action.close'),
      message,
      multiLine: true,
      position: 'bottom',
      type: 'info',
    })
  },
  success: (message) => {
    return Notify.create({
      badgeColor: 'yellow',
      badgeTextColor: 'black',
      closeBtn: $t('action.close'),
      message,
      multiLine: true,
      position: 'bottom',
      type: 'positive',
    })
  },
  warning(message, actions = []) {
    return Notify.create({
      actions,
      badgeColor: 'yellow',
      badgeTextColor: 'black',
      closeBtn: $t('action.close'),
      message,
      multiLine: true,
      position: 'bottom',
      type: 'warning',
    })
  },
}
