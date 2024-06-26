import { $t } from 'boot/i18n'
import { defineStore } from 'pinia'
import axios from 'axios'
import notify from 'src/utils/helpers/notify'

export const useCommentsStore = defineStore('comments', {
  state: () => ({
    count: 0,
    form: {
      article_id: null,
      author_email: '',
      author_username: '',
      content: '',
      title: '',
    },
    list: [], // список комментариев
  }),

  actions: {
    /**
     * Сохраняет комментарий.
     * @returns {Promise}
     */
    async create() {
      return axios
        .post('/api/comments', this.form)
        .then(() => {
          notify.success($t('message.success.comment.create'))
        })
        .catch(() => {
          notify.error($t('message.error.comment.create'))
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
    /**
     * Изменяет идентификатор статьи комментария.
     * @param {Number} id
     * @returns {void}
     */
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
