// @ts-check
import { $t } from '../../../src/boot/i18n'
import config from '../../config'
import fixtures from '../../fixtures'
import routes from '../../../src/utils/consts/routes/index'

const { test, expect } = require('@playwright/test')

test('positive article show', async ({ page }) => {
  /* Arrange */
  // Переходим на страницу списка статей
  await page.goto(config.link.baseUrl + routes.ARTICLE.INDEX)

  // Нажимаем кнопку "Добавить статью"
  await page.getByRole('button', { name: $t('action.add.article') }).click()

  // Находим модальное окно добавления статьи
  const dialog = page.getByRole('dialog')

  // Заполняем форму
  await expect(page.getByLabel($t('field.title.article'))).toBeEmpty()
  await page.getByLabel($t('field.title.article')).click()
  await page.getByLabel($t('field.title.article')).fill(fixtures.article.create.title)

  await expect(page.locator('.q-editor__content')).toBeEmpty()
  await page.locator('.q-editor__content').click()
  await page.locator('.q-editor__content').fill(fixtures.article.create.content)

  await expect(page.getByLabel($t('field.username'))).toBeEmpty()
  await page.getByLabel($t('field.username')).click()
  await page.getByLabel($t('field.username')).fill(fixtures.article.create.authorUsername)

  await expect(page.getByLabel($t('field.email'))).toBeEmpty()
  await page.getByLabel($t('field.email')).click()
  await page.getByLabel($t('field.email')).fill(fixtures.article.create.authorEmail)

  // Нажимаем кнопку "Сохранить"
  await dialog.getByRole('button', { name: $t('action.save') }).click()

  // В списке должна быть новая статья
  const article = page.locator('.q-card').filter({ hasText: fixtures.article.create.title })
  await expect(article).toHaveCount(1)

  /* Act */
  // Переходим на страницу просмотра статьи
  await page.getByRole('link', { name: fixtures.article.create.title }).click()

  /* Assert */
  // Проверяем заголовок
  await expect(page.getByRole('article').first()).toHaveText(
    new RegExp(fixtures.article.create.title),
  )
  await expect(page.getByRole('article').first()).toHaveText(
    new RegExp(fixtures.article.create.content),
  )

  /** After */
  // Переходим на страницу списка статей
  await page.goto(config.link.baseUrl + routes.ARTICLE.INDEX)

  // Удаляем созданную статью
  await article.getByRole('button', { name: $t('action.delete') }).click()
  await page
    .getByRole('dialog')
    .getByRole('button', { name: $t('action.delete') })
    .click()
})
