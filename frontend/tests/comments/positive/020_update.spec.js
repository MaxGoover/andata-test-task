// @ts-check
import { $t } from '../../../src/boot/i18n'
import { castHexToRgb } from '../../../src/utils/helpers/index'
import colors from '../../../src/utils/consts/colors'
import config from '../../config'
import fixtures from '../../fixtures'
import routes from '../../../src/utils/consts/routes/index'

const { test, expect } = require('@playwright/test')

test('positive comment update', async ({ page }) => {
  /* Arrange */
  // Переходим на страницу списка статей
  await page.goto(config.link.baseUrl + routes.ARTICLE.INDEX)

  // Нажимаем кнопку "Добавить статью"
  await page.getByRole('button', { name: $t('action.add.article') }).click()

  // Заполняем форму статьи
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
  await page
    .getByRole('dialog')
    .getByRole('button', { name: $t('action.save') })
    .click()

  // Переходим на страницу просмотра статьи
  await page.getByRole('link', { name: fixtures.article.create.title }).click()

  // Заполняем форму комментария
  await expect(page.getByLabel($t('field.title.comment'))).toBeEmpty()
  await page.getByLabel($t('field.title.comment')).click()
  await page.getByLabel($t('field.title.comment')).fill(fixtures.comment.create.title)

  await expect(page.locator('.q-editor__content')).toBeEmpty()
  await page.locator('.q-editor__content').click()
  await page.locator('.q-editor__content').fill(fixtures.comment.create.content)

  await expect(page.getByLabel($t('field.username'))).toBeEmpty()
  await page.getByLabel($t('field.username')).click()
  await page.getByLabel($t('field.username')).fill(fixtures.comment.create.authorUsername)

  await expect(page.getByLabel($t('field.email'))).toBeEmpty()
  await page.getByLabel($t('field.email')).click()
  await page.getByLabel($t('field.email')).fill(fixtures.comment.create.authorEmail)

  // Нажимаем кнопку "Сохранить"
  await page.getByRole('button', { name: $t('action.save') }).click()

  // В списке должна быть новый комментарий
  let comment = page.locator('.q-card').filter({ hasText: fixtures.comment.create.title })
  await expect(comment).toHaveCount(1)

  // Запоминаем текущее количество комментариев
  const titleComments = `div:has(span:has-text("${$t('title.comments')}"))`
  const countComments = Number(
    await page.locator(titleComments).getByRole('figure').first().innerText(),
  )

  /* Act */
  // У созданного комментария нажимаем кнопку "Редактировать"
  await comment.getByRole('button', { name: $t('action.edit') }).click()

  // Проверяем, чтобы заголовок у модального окна был "Редактировать комментарий"
  await expect(
    page
      .getByRole('dialog')
      .locator('div')
      .filter({ hasText: new RegExp(`^${$t('title.edit.comment')}$`) }),
  ).toHaveCount(1)

  // Изменяем данные формы комментария
  await expect(page.getByLabel($t('field.title.comment'))).not.toBeEmpty()
  await page.getByLabel($t('field.title.comment')).click()
  await page.getByLabel($t('field.title.comment')).clear()
  await page.getByLabel($t('field.title.comment')).fill(fixtures.comment.update.title)

  await expect(page.locator('.q-editor__content')).not.toBeEmpty()
  await page.locator('.q-editor__content').click()
  await page.locator('.q-editor__content').clear()
  await page.locator('.q-editor__content').fill(fixtures.comment.update.content)

  await expect(page.getByLabel($t('field.username'))).not.toBeEmpty()
  await page.getByLabel($t('field.username')).click()
  await page.getByLabel($t('field.username')).clear()
  await page.getByLabel($t('field.username')).fill(fixtures.comment.update.authorUsername)

  await expect(page.getByLabel($t('field.email'))).not.toBeEmpty()
  await page.getByLabel($t('field.email')).click()
  await page.getByLabel($t('field.email')).clear()
  await page.getByLabel($t('field.email')).fill(fixtures.comment.update.authorEmail)

  // Нажимаем кнопку сохранить
  await page
    .getByRole('dialog')
    .getByRole('button', { name: $t('action.save') })
    .click()

  /* Assert */
  // В списке комментариев должен быть измененный комментарий
  comment = page.locator('.q-card').filter({ hasText: fixtures.comment.update.title })
  await expect(comment).toHaveCount(1)

  // Должна быть всплывашка зеленого цвета, что статья добавлена
  const alert = page
    .getByRole('alert')
    .filter({ hasText: new RegExp($t('message.success.comment.update')) })
  await expect(alert).toHaveCount(1)
  await expect(alert).toHaveCSS('background-color', castHexToRgb(colors.POSITIVE))

  // Получаем id статьи из текущего URL
  const matchUrl = page.url().match(/\/(\d+)$/)
  let articleId = null
  if (matchUrl) {
    articleId = matchUrl[1]
  }

  // Проверяем, что кол-во комментариев на странице не изменилось
  const newCountComments = Number(
    await page.locator(titleComments).getByRole('figure').first().innerText(),
  )
  expect(newCountComments).toBe(countComments)

  // Мы должны быть на странице /articles/{id}
  await expect(page).toHaveURL(config.link.baseUrl + routes.ARTICLE.SHOW(articleId))

  /** After */
  // Переходим на страницу списка статей
  await page.goto(config.link.baseUrl + routes.ARTICLE.INDEX)

  // Удаляем созданную статью
  const article = page.locator('.q-card').filter({ hasText: fixtures.article.create.title }).first()
  await article.getByRole('button', { name: $t('action.delete') }).click()
  await page
    .getByRole('dialog')
    .getByRole('button', { name: $t('action.delete') })
    .click()
})
