import { defineStore } from 'pinia'
import { i18n } from 'boot/i18n'
import { ref } from 'vue'
import axios from 'axios'
import notify from 'src/utils/helpers/notify'

export const useCommentsStore = defineStore('comments', {
  state: () => ({
    count: 0,
    form: {
      article_id: 0,
      author_email: 'maxgoover@gmail.com',
      author_username: 'MaxGoover',
      content:
        '<p>Каждый раз когда вижу эти спирали к фотографиям, прям слышу как где-то кричит сова.</p>',
      title: 'Это - заголовок комментария',
    },
    list: ref([]), // список комментариев
  }),

  actions: {
    /**
     * Сохраняет комментарий.
     * @returns {Promise}
     */
    async create() {
      return axios
        .post('/api/comments/create', this.form)
        .then(() => {
          this.clearForm()
          notify.success(i18n.global.t('message.success.comments.create'))
        })
        .catch(() => {
          notify.error(i18n.global.t('message.error.comments.create'))
        })
    },
    /**
     * Очищает форму комментария.
     * @returns {void}
     */
    clearForm() {
      this.form.author_email = ''
      this.form.author_username = ''
      this.form.content = ''
      this.form.title = ''
    },
    setFormArticleId(id) {
      this.form.article_id = id
    },
    /**
     * Изменяет кол-во комментариев.
     * @param {Number} count
     * @returns {void}
     */
    setCount(count) {
      this.count = count
    },
    /**
     * Изменяет список комментариев.
     * @param {Array} comments
     * @returns {void}
     */
    setList(comments) {
      this.list = comments
    },
  },
})
