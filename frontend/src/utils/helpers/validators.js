// Обертка над валидатором для более тонкой настройки валидации
import { $t } from 'boot/i18n'
import {
  email as vEmail,
  helpers,
  maxLength as vMaxLength,
  minLength as vMinLength,
  required as vRequired,
} from '@vuelidate/validators'

export const email = helpers.withMessage($t('validator.email'), vEmail)

export const maxLength = (max) =>
  helpers.withMessage(
    ({ $params }) => $t('validator.maxLength') + ' - ' + $params.max ,
    vMaxLength(max),
  )

export const minLength = (min) =>
  helpers.withMessage(
    ({ $params }) => $t('validator.minLength') + ' - ' + $params.min ,
    vMinLength(min),
  )

export const required = helpers.withMessage($t('validator.required'), vRequired)
