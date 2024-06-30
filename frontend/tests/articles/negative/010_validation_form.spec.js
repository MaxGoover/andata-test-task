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
  const buttonSave = page.getByRole('dialog').getByRole('button', { name: $t('action.save') })
  const alerts = page.getByRole('alert')
  const fieldTitle = page.getByLabel($t('field.title.article'))
  const labelTitleLocator = page
    .locator('label')
    .filter({ hasText: new RegExp($t('field.title.article')) })

  await (async function required() {
    await fieldTitle.click()
    await fieldTitle.clear()
    await buttonSave.click()

    const labelTitle = labelTitleLocator.first()
    await expect(labelTitle).toHaveText(new RegExp($t('validator.required')))

    const alert = alerts.filter({ hasText: new RegExp($t('message.error.validation')) }).last()
    await expect(alert).toHaveCSS('background-color', castHexToRgb(colors.NEGATIVE))
  })()

  await (async function minLength() {
    await fieldTitle.click()
    await fieldTitle.clear()
    await fieldTitle.fill(generateString(validation.article.title.minLength - 1))
    await buttonSave.click()

    const labelTitle = labelTitleLocator.first()
    await expect(labelTitle).toHaveText(new RegExp($t('validator.minLength')))

    const alert = alerts.filter({ hasText: new RegExp($t('message.error.validation')) }).last()
    await expect(alert).toHaveCSS('background-color', castHexToRgb(colors.NEGATIVE))
  })()

  await (async function maxLength() {
    await fieldTitle.click()
    await fieldTitle.clear()
    await fieldTitle.fill(generateString(validation.article.title.maxLength + 1))
    await buttonSave.click()

    const labelTitle = labelTitleLocator.first()
    await expect(labelTitle).toHaveText(new RegExp($t('validator.maxLength')))

    const alert = alerts.filter({ hasText: new RegExp($t('message.error.validation')) }).last()
    await expect(alert).toHaveCSS('background-color', castHexToRgb(colors.NEGATIVE))
  })()
})

test('negative article validation form content', async ({ page }) => {
  const buttonSave = page.getByRole('dialog').getByRole('button', { name: $t('action.save') })
  const alerts = page.getByRole('alert')
  const fieldContent = page.getByPlaceholder(new RegExp($t('field.text.article')))
  const labelContentLocator =
    'label' +
    ':has(.q-editor__content)' +
    `:has(div[placeholder="${$t('field.text.article')}"])` +
    ':has(div[role="alert"])'

  await (async function required() {
    await fieldContent.click()
    await fieldContent.clear()
    await buttonSave.click()

    let labelContent = page.locator(labelContentLocator).first()
    await expect(labelContent).toHaveText(new RegExp($t('validator.required')))

    let alert = alerts.filter({ hasText: new RegExp($t('message.error.validation')) }).last()
    await expect(alert).toHaveCSS('background-color', castHexToRgb(colors.NEGATIVE))
  })()

  await (async function minLength() {
    await fieldContent.clear()
    await fieldContent.click()
    await fieldContent.fill(generateString(validation.article.content.minLength - 1))
    await buttonSave.click()

    const labelContent = page.locator(labelContentLocator).first()
    await expect(labelContent).toHaveText(new RegExp($t('validator.minLength')))

    const alert = alerts.filter({ hasText: new RegExp($t('message.error.validation')) }).last()
    await expect(alert).toHaveCSS('background-color', castHexToRgb(colors.NEGATIVE))
  })()

  await (async function maxLength() {
    await fieldContent.clear()
    await fieldContent.click()
    await fieldContent.fill(generateString(validation.article.content.maxLength + 1))
    await buttonSave.click()

    const labelContent = page.locator(labelContentLocator).first()
    await expect(labelContent).toHaveText(new RegExp($t('validator.maxLength')))

    const alert = alerts.filter({ hasText: new RegExp($t('message.error.validation')) }).last()
    await expect(alert).toHaveCSS('background-color', castHexToRgb(colors.NEGATIVE))
  })()
})

test('negative article validation form author_username', async ({ page }) => {
  const buttonSave = page.getByRole('dialog').getByRole('button', { name: $t('action.save') })
  const alerts = page.getByRole('alert')
  const fieldAuthorUsername = page.getByLabel($t('field.username'))
  const labelAuthorUsernameLocator = page
    .locator('label')
    .filter({ hasText: new RegExp($t('field.username')) })

  await (async function required() {
    await fieldAuthorUsername.click()
    await fieldAuthorUsername.clear()
    await buttonSave.click()

    const labelAuthorUsername = labelAuthorUsernameLocator.first()
    await expect(labelAuthorUsername).toHaveText(new RegExp($t('validator.required')))

    const alert = alerts.filter({ hasText: new RegExp($t('message.error.validation')) }).last()
    await expect(alert).toHaveCSS('background-color', castHexToRgb(colors.NEGATIVE))
  })()

  await (async function minLength() {
    await fieldAuthorUsername.clear()
    await fieldAuthorUsername.click()
    await fieldAuthorUsername.fill(generateString(validation.username.minLength - 1))
    await buttonSave.click()

    const labelAuthorUsername = labelAuthorUsernameLocator.first()
    await expect(labelAuthorUsername).toHaveText(new RegExp($t('validator.minLength')))

    const alert = alerts.filter({ hasText: new RegExp($t('message.error.validation')) }).last()
    await expect(alert).toHaveCSS('background-color', castHexToRgb(colors.NEGATIVE))
  })()

  await (async function maxLength() {
    await fieldAuthorUsername.clear()
    await fieldAuthorUsername.click()
    await fieldAuthorUsername.fill(generateString(validation.username.maxLength + 1))
    await buttonSave.click()

    const labelAuthorUsername = labelAuthorUsernameLocator.first()
    await expect(labelAuthorUsername).toHaveText(new RegExp($t('validator.maxLength')))

    const alert = alerts.filter({ hasText: new RegExp($t('message.error.validation')) }).last()
    await expect(alert).toHaveCSS('background-color', castHexToRgb(colors.NEGATIVE))
  })()
})

test('negative article validation form author_email', async ({ page }) => {
  const buttonSave = page.getByRole('dialog').getByRole('button', { name: $t('action.save') })
  const alerts = page.getByRole('alert')
  const fieldAuthorEmail = page.getByLabel($t('field.email'))
  const labelAuthorEmailLocator = page
    .locator('label')
    .filter({ hasText: new RegExp($t('field.email')) })

  await (async function required() {
    await fieldAuthorEmail.click()
    await fieldAuthorEmail.clear()
    await buttonSave.click()

    const labelAuthorUsername = labelAuthorEmailLocator.first()
    await expect(labelAuthorUsername).toHaveText(new RegExp($t('validator.required')))

    const alert = alerts.filter({ hasText: new RegExp($t('message.error.validation')) }).last()
    await expect(alert).toHaveCSS('background-color', castHexToRgb(colors.NEGATIVE))
  })()

  await (async function maxLength() {
    await fieldAuthorEmail.clear()
    await fieldAuthorEmail.click()
    await fieldAuthorEmail.fill(generateString(validation.email.maxLength + 1) + '@mail.ru')
    await buttonSave.click()

    const labelAuthorUsername = labelAuthorEmailLocator.first()
    await expect(labelAuthorUsername).toHaveText(new RegExp($t('validator.maxLength')))

    const alert = alerts.filter({ hasText: new RegExp($t('message.error.validation')) }).last()
    await expect(alert).toHaveCSS('background-color', castHexToRgb(colors.NEGATIVE))
  })()

  await (async function email() {
    await fieldAuthorEmail.clear()
    await fieldAuthorEmail.click()
    await fieldAuthorEmail.fill('@mail.ru')
    await buttonSave.click()

    const labelAuthorUsername = labelAuthorEmailLocator.first()
    await expect(labelAuthorUsername).toHaveText(new RegExp($t('validator.email')))

    const alert = alerts.filter({ hasText: new RegExp($t('message.error.validation')) }).last()
    await expect(alert).toHaveCSS('background-color', castHexToRgb(colors.NEGATIVE))
  })()
})
