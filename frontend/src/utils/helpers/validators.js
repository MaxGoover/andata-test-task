// Обертка над валидатором для более тонкой настройки валидации
import {
  email as vEmail,
  helpers,
  maxLength as vMaxLength,
  minLength as vMinLength,
  required as vRequired,
} from '@vuelidate/validators'
import { i18n } from 'boot/i18n'

export const email = helpers.withMessage(i18n.global.t('validators.email'), vEmail)

export const maxLength = (max) =>
  helpers.withMessage(
    ({ $params }) => i18n.global.t('validators.maxLength', { length: $params.max }),
    vMaxLength(max),
  )

export const minLength = (min) =>
  helpers.withMessage(
    ({ $params }) => i18n.global.t('validators.minLength', { length: $params.min }),
    vMinLength(min),
  )

export const required = helpers.withMessage(i18n.global.t('validators.required'), vRequired)
