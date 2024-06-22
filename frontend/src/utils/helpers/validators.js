// Обертка над валидатором для более тонкой настройки валидации
import { $t } from 'boot/i18n'
import {
  email as vEmail,
  helpers,
  maxLength as vMaxLength,
  minLength as vMinLength,
  required as vRequired,
} from '@vuelidate/validators'

export const email = helpers.withMessage($t('validators.email'), vEmail)

export const maxLength = (max) =>
  helpers.withMessage(
    ({ $params }) => $t('validators.maxLength', { length: $params.max }),
    vMaxLength(max),
  )

export const minLength = (min) =>
  helpers.withMessage(
    ({ $params }) => $t('validators.minLength', { length: $params.min }),
    vMinLength(min),
  )

export const required = helpers.withMessage($t('validators.required'), vRequired)
