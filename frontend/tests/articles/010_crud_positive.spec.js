// @ts-check
import { $t } from '../../src/boot/i18n'
import { castHexToRgb } from '../../src/utils/helpers/index'
import colors from '../../src/utils/consts/colors'
import config from '../config'
import routes from '../../src/utils/consts/routes/index'

const { test, expect } = require('@playwright/test')

test('create article', async ({ page }) => {
  /* Arrange */
  await page.goto(config.link.baseUrl + routes.ARTICLE.INDEX)

  // Считаем кол-во статей на странице
  let list = page.locator('.q-list > .q-card')
  await expect(list).toHaveCount(3)

  await page.getByRole('button', { name: $t('action.add.article') }).click()

  await expect(
    page.locator('div').filter({ hasText: new RegExp(`^${$t('title.add.article')}$`) }),
  ).toHaveCount(1)

  await expect(page.getByLabel($t('field.title.article'))).toBeEmpty()
  await page.getByLabel($t('field.title.article')).click()
  await page.getByLabel($t('field.title.article')).fill('Тестовый заголовок тестовой статьи')

  await expect(page.locator('.q-editor__content')).toBeEmpty()
  await page.locator('.q-editor__content').click()
  await page.locator('.q-editor__content').fill('Тестовое содержание тестовой статьи')

  await expect(page.getByLabel($t('field.username'))).toBeEmpty()
  await page.getByLabel($t('field.username')).click()
  await page.getByLabel($t('field.username')).fill('MaxGoover')

  await expect(page.getByLabel($t('field.email'))).toBeEmpty()
  await page.getByLabel($t('field.email')).click()
  await page.getByLabel($t('field.email')).fill('maxgoover@gmail.com')

  /* Act */
  await page.getByRole('button', { name: $t('action.save') }).click()

  /* Assert */
  // Мы должны быть на странице /articles
  await expect(page).toHaveURL(config.link.baseUrl + routes.ARTICLE.INDEX)

  // Считаем кол-во статей на странице
  list = page.locator('.q-list > .q-card')
  await expect(list).toHaveCount(4)

  // В списке должна быть новая статья
  const articles = page.locator('.q-card')
  const article = articles.filter({ hasText: 'Тестовый заголовок тестовой статьи' })
  await expect(article).toHaveCount(1)

  // Должна быть всплывашка зеленого цвета, что статья добавлена
  const alerts = page.getByRole('alert')
  const alert = alerts.filter({ hasText: new RegExp($t('message.success.articles.create')) })
  await expect(alert).toHaveCount(1)
  await expect(page.getByRole('alert')).toHaveCSS('background-color', castHexToRgb(colors.POSITIVE))
})

test('update article', async ({ page }) => {
  /* Arrange */
  await page.goto(config.link.baseUrl + routes.ARTICLE.INDEX)

  // Считаем кол-во статей на странице
  let list = page.locator('.q-list > .q-card')
  await expect(list).toHaveCount(4)

  let articles = page.locator('.q-card')
  let article = articles.filter({ hasText: 'Тестовый заголовок тестовой статьи' })
  await expect(article).toHaveCount(1)

  await article.getByRole('button', { name: $t('action.edit') }).click()

  await expect(
    page.locator('div').filter({ hasText: new RegExp(`^${$t('title.edit.article')}$`) }),
  ).toHaveCount(1)

  await expect(page.getByLabel($t('field.title.article'))).not.toBeEmpty()
  await page.getByLabel($t('field.title.article')).click()
  await page.getByLabel($t('field.title.article')).clear()
  await page.getByLabel($t('field.title.article')).fill('Измененный заголовок тестовой статьи')

  await expect(page.locator('.q-editor__content')).not.toBeEmpty()
  await page.locator('.q-editor__content').click()
  await page.locator('.q-editor__content').clear()
  await page.locator('.q-editor__content').fill('Измененное содержание тестовой статьи')

  await expect(page.getByLabel($t('field.username'))).not.toBeEmpty()
  await page.getByLabel($t('field.username')).click()
  await page.getByLabel($t('field.username')).clear()
  await page.getByLabel($t('field.username')).fill('AnotherMaxGoover')

  await expect(page.getByLabel($t('field.email'))).not.toBeEmpty()
  await page.getByLabel($t('field.email')).click()
  await page.getByLabel($t('field.email')).clear()
  await page.getByLabel($t('field.email')).fill('another_maxgoover@gmail.com')

  /* Act */
  await page.getByRole('button', { name: $t('action.save') }).click()

  /* Assert */
  // Мы должны быть на странице /articles
  await expect(page).toHaveURL(config.link.baseUrl + routes.ARTICLE.INDEX)

  // Считаем кол-во статей на странице
  list = page.locator('.q-list > .q-card')
  await expect(list).toHaveCount(4)

  // В списке должна быть измененная статья
  articles = page.locator('.q-card')
  article = articles.filter({ hasText: 'Измененный заголовок тестовой статьи' })
  await expect(article).toHaveCount(1)

  // Должна быть всплывашка зеленого цвета, что статья изменена
  const alerts = page.getByRole('alert')
  const alert = alerts.filter({ hasText: new RegExp($t('message.success.articles.update')) })
  await expect(alert).toHaveCount(1)
  await expect(page.getByRole('alert')).toHaveCSS('background-color', castHexToRgb(colors.POSITIVE))
})

test('delete article', async ({ page }) => {
  /* Arrange */
  await page.goto(config.link.baseUrl + routes.ARTICLE.INDEX)

  // Считаем кол-во статей на странице
  let list = page.locator('.q-list > .q-card')
  await expect(list).toHaveCount(4)

  // Находим тестовую статью
  let articles = page.locator('.q-card')
  let article = articles.filter({ hasText: 'Измененный заголовок тестовой статьи' })
  await expect(article).toHaveCount(1)

  await article.getByRole('button', { name: $t('action.delete') }).click()

  await expect(
    page.locator('div').filter({ hasText: new RegExp(`^${$t('title.delete.article')}$`) }),
  ).toHaveCount(1)

  /* Act */
  await page.getByRole('dialog').getByRole('button', { name: $t('action.delete') }).click()

  /* Assert */
  // Мы должны быть на странице /articles
  await expect(page).toHaveURL(config.link.baseUrl + routes.ARTICLE.INDEX)

  // Считаем кол-во статей на странице
  list = page.locator('.q-list > .q-card')
  await expect(list).toHaveCount(3)

  // В списке должна быть измененная статья
  articles = page.locator('.q-card')
  article = articles.filter({ hasText: 'Измененный заголовок тестовой статьи' })
  await expect(article).toHaveCount(0)

  // Должна быть всплывашка зеленого цвета, что статья удалена
  const alerts = page.getByRole('alert')
  const alert = alerts.filter({ hasText: new RegExp($t('message.success.articles.delete')) })
  await expect(alert).toHaveCount(1)
  await expect(page.getByRole('alert')).toHaveCSS('background-color', castHexToRgb(colors.POSITIVE))
})
