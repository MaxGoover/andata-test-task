// @ts-check
import { $t } from '../../../src/boot/i18n'
import { castHexToRgb } from '../../../src/utils/helpers/index'
import { generateString } from '../../../src/utils/helpers/index'
import colors from '../../../src/utils/consts/colors'
import config from '../../config'
import routes from '../../../src/utils/consts/routes/index'
import validation from '../../../src/utils/settings/validation'

const { test, expect } = require('@playwright/test')

test.beforeEach(async ({ page }) => {
  /* Arrange */
  // Переходим на страницу /articles
  await page.goto(config.link.baseUrl + routes.ARTICLE.INDEX)

  // Нажимаем кнопку "Добавить статью"
  await page.getByRole('button', { name: $t('action.add.article') }).click()

  // Проверяем, чтобы заголовок у модального окна был "Добавить статью"
  await expect(
    page
      .getByRole('dialog')
      .locator('div')
      .filter({ hasText: new RegExp(`^${$t('title.add.article')}$`) }),
  ).toHaveCount(1)
})

test('negative article validation form title', async ({ page }) => {
  const fieldTitle = page.getByLabel($t('field.title.article'))
  const buttonSave = page.getByRole('dialog').getByRole('button', { name: $t('action.save') })
  const alerts = page.getByRole('alert')

  // title required
  await fieldTitle.click()
  await fieldTitle.clear()
  await buttonSave.click()

  let alert = alerts.filter({ hasText: new RegExp($t('message.error.validation')) }).last()
  await expect(alert).toHaveCSS('background-color', castHexToRgb(colors.NEGATIVE))

  // title minLength
  await fieldTitle.click()
  await fieldTitle.clear()
  await fieldTitle.fill(generateString(validation.article.title.minLength - 1))
  await buttonSave.click()

  alert = alerts.filter({ hasText: new RegExp($t('message.error.validation')) }).last()
  await expect(alert).toHaveCSS('background-color', castHexToRgb(colors.NEGATIVE))

  // title maxLength
  await fieldTitle.click()
  await fieldTitle.clear()
  await fieldTitle.fill(generateString(validation.article.title.maxLength + 1))
  await buttonSave.click()

  alert = alerts.filter({ hasText: new RegExp($t('message.error.validation')) }).last()
  await expect(alert).toHaveCSS('background-color', castHexToRgb(colors.NEGATIVE))
})

test('negative article validation form content', async ({ page }) => {
  const fieldContent = page.locator('.q-editor__content')
  const buttonSave = page.getByRole('dialog').getByRole('button', { name: $t('action.save') })
  const alerts = page.getByRole('alert')

  // content required
  await fieldContent.clear()
  await buttonSave.click()

  let alert = alerts.filter({ hasText: new RegExp($t('message.error.validation')) }).last()
  await expect(alert).toHaveCSS('background-color', castHexToRgb(colors.NEGATIVE))

  // content minLength
  await fieldContent.clear()
  await fieldContent.click()
  await fieldContent.fill(generateString(validation.article.content.minLength - 1))
  await buttonSave.click()

  alert = alerts.filter({ hasText: new RegExp($t('message.error.validation')) }).last()
  await expect(alert).toHaveCSS('background-color', castHexToRgb(colors.NEGATIVE))

  // content maxLength
  await fieldContent.clear()
  await fieldContent.click()
  await fieldContent.fill(generateString(validation.article.content.maxLength + 1))
  await buttonSave.click()

  alert = alerts.filter({ hasText: new RegExp($t('message.error.validation')) }).last()
  await expect(alert).toHaveCSS('background-color', castHexToRgb(colors.NEGATIVE))
})

test('negative article validation form author_username', async ({ page }) => {
  const fieldAuthorUsername = page.getByLabel($t('field.username'))
  const buttonSave = page.getByRole('dialog').getByRole('button', { name: $t('action.save') })
  const alerts = page.getByRole('alert')

  // author_username required
  await fieldAuthorUsername.clear()
  await buttonSave.click()

  let alert = alerts.filter({ hasText: new RegExp($t('message.error.validation')) }).last()
  await expect(alert).toHaveCSS('background-color', castHexToRgb(colors.NEGATIVE))

  // author_username minLength
  await fieldAuthorUsername.clear()
  await fieldAuthorUsername.click()
  await fieldAuthorUsername.fill(generateString(validation.username.minLength - 1))
  await buttonSave.click()

  alert = alerts.filter({ hasText: new RegExp($t('message.error.validation')) }).last()
  await expect(alert).toHaveCSS('background-color', castHexToRgb(colors.NEGATIVE))

  // author_username maxLength
  await fieldAuthorUsername.clear()
  await fieldAuthorUsername.click()
  await fieldAuthorUsername.fill(generateString(validation.username.maxLength + 1))
  await buttonSave.click()

  alert = alerts.filter({ hasText: new RegExp($t('message.error.validation')) }).last()
  await expect(alert).toHaveCSS('background-color', castHexToRgb(colors.NEGATIVE))
})

test('negative article validation form author_email', async ({ page }) => {
  const fieldAuthorEmail = page.getByLabel($t('field.email'))
  const buttonSave = page.getByRole('dialog').getByRole('button', { name: $t('action.save') })
  const alerts = page.getByRole('alert')

  // author_email required
  await fieldAuthorEmail.clear()
  await buttonSave.click()

  let alert = alerts.filter({ hasText: new RegExp($t('message.error.validation')) }).last()
  await expect(alert).toHaveCSS('background-color', castHexToRgb(colors.NEGATIVE))

  // author_email maxLength
  await fieldAuthorEmail.clear()
  await fieldAuthorEmail.click()
  await fieldAuthorEmail.fill(generateString(validation.email.maxLength + 1) + '@mail.ru')
  await buttonSave.click()

  alert = alerts.filter({ hasText: new RegExp($t('message.error.validation')) }).last()
  await expect(alert).toHaveCSS('background-color', castHexToRgb(colors.NEGATIVE))

  // author_email email
  await fieldAuthorEmail.clear()
  await fieldAuthorEmail.click()
  await fieldAuthorEmail.fill('@mail.ru')
  await buttonSave.click()

  alert = alerts.filter({ hasText: new RegExp($t('message.error.validation')) }).last()
  await expect(alert).toHaveCSS('background-color', castHexToRgb(colors.NEGATIVE))
})
