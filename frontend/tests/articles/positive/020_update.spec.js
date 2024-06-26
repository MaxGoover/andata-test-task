// @ts-check
import { $t } from '../../../src/boot/i18n'
import { castHexToRgb } from '../../../src/utils/helpers/index'
import colors from '../../../src/utils/consts/colors'
import config from '../../config'
import fixtures from '../../fixtures'
import routes from '../../../src/utils/consts/routes/index'

const { test, expect } = require('@playwright/test')

test('positive article update', async ({ page }) => {
  /* Arrange */
  await page.goto(config.link.baseUrl + routes.ARTICLE.INDEX)

  // Считаем кол-во статей на странице
  await page.locator('.q-list > .q-card').first().waitFor()
  const countArticleItems = await page.locator('.q-list > .q-card').count()

  // Проверяем кол-во статей на странице
  await expect(page.locator('.q-list > .q-card')).toHaveCount(countArticleItems)

  // Нажимаем кнопку "Добавить статью"
  await page.getByRole('button', { name: $t('action.add.article') }).click()

  // Находим модальное окно
  let dialog = page.getByRole('dialog')

  // Проверяем, чтобы заголовок у модального окна был "Добавить статью"
  await expect(
    dialog.locator('div').filter({ hasText: new RegExp(`^${$t('title.add.article')}$`) }),
  ).toHaveCount(1)

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

  // Мы должны быть на странице /articles
  await expect(page).toHaveURL(config.link.baseUrl + routes.ARTICLE.INDEX)

  // Проверяем, чтобы кол-во статей на странице было +1
  await expect(page.locator('.q-list > .q-card')).toHaveCount(countArticleItems + 1)

  // В списке должна быть новая статья
  let article = page.locator('.q-card').filter({ hasText: fixtures.article.create.title })
  await expect(article).toHaveCount(1)

  // Должна быть всплывашка зеленого цвета, что статья добавлена
  let alert = page
    .getByRole('alert')
    .filter({ hasText: new RegExp($t('message.success.articles.create')) })
  await expect(alert).toHaveCount(1)
  await expect(alert).toHaveCSS('background-color', castHexToRgb(colors.POSITIVE))

  // У созданной статьи нажимаем кнопку "Редактировать"
  await article.getByRole('button', { name: $t('action.edit') }).click()

  // Находим модальное окно
  dialog = page.getByRole('dialog')

  // Проверяем, чтобы заголовок у модального окна был "Редактировать статью"
  await expect(
    dialog.locator('div').filter({ hasText: new RegExp(`^${$t('title.edit.article')}$`) }),
  ).toHaveCount(1)

  // Изменяем данные формы статьи
  await expect(page.getByLabel($t('field.title.article'))).not.toBeEmpty()
  await page.getByLabel($t('field.title.article')).click()
  await page.getByLabel($t('field.title.article')).clear()
  await page.getByLabel($t('field.title.article')).fill(fixtures.article.update.title)

  await expect(page.locator('.q-editor__content')).not.toBeEmpty()
  await page.locator('.q-editor__content').click()
  await page.locator('.q-editor__content').clear()
  await page.locator('.q-editor__content').fill(fixtures.article.update.content)

  await expect(page.getByLabel($t('field.username'))).not.toBeEmpty()
  await page.getByLabel($t('field.username')).click()
  await page.getByLabel($t('field.username')).clear()
  await page.getByLabel($t('field.username')).fill(fixtures.article.update.authorUsername)

  await expect(page.getByLabel($t('field.email'))).not.toBeEmpty()
  await page.getByLabel($t('field.email')).click()
  await page.getByLabel($t('field.email')).clear()
  await page.getByLabel($t('field.email')).fill(fixtures.article.update.authorEmail)

  /* Act */
  // Нажимаем кнопку сохранить
  await page.getByRole('button', { name: $t('action.save') }).click()

  /* Assert */
  // Мы должны быть на странице /articles
  await expect(page).toHaveURL(config.link.baseUrl + routes.ARTICLE.INDEX)

  // Проверяем, чтобы кол-во статей на странице не изменилось
  await expect(page.locator('.q-list > .q-card')).toHaveCount(countArticleItems + 1)

  // В списке статей должна быть измененная статья
  article = page.locator('.q-card').filter({ hasText: fixtures.article.update.title })
  await expect(article).toHaveCount(1)

  // Должна быть всплывашка зеленого цвета, что статья отредактирована успешно
  alert = page
    .getByRole('alert')
    .filter({ hasText: new RegExp($t('message.success.articles.create')) })
  await expect(alert).toHaveCount(1)
  await expect(alert).toHaveCSS('background-color', castHexToRgb(colors.POSITIVE))

  /** After */
  // Удаляем созданную статью
  await article.getByRole('button', { name: $t('action.delete') }).click()
  await page
    .getByRole('dialog')
    .getByRole('button', { name: $t('action.delete') })
    .click()

  // Проверяем, что отредактированной статьи больше нет
  article = page.locator('.q-card').filter({ hasText: fixtures.article.update.title })
  await expect(article).toHaveCount(0)

  // Проверяем, что количество статей вернулось как было изначально
  await expect(page.locator('.q-list > .q-card')).toHaveCount(countArticleItems)
})
