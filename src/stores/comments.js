import { defineStore } from 'pinia'
import { i18n } from 'boot/i18n'
import axios from 'axios'
import notify from 'src/utils/helpers/notify'

export const useCommentsStore = defineStore('comments', {
  state: () => ({
    form: {
      author: { email: '', username: '' },
      content: '',
      created_at: '2024-04-15 16:47:01',
      id: 1,
      title: '',
    },
    list: [], // список комментариев
  }),

  actions: {
    /**
     * Сохраняет комментарий.
     * @returns {Promise}
     */
    async store() {
      return axios
        .post('/comments', this.form)
        .then(() => {
          this.clearForm()
        })
        .catch(() => {
          notify.error(i18n.global.t('message.error.comments.store'))
        })
    },
    /**
     * Очищает форму комментария.
     * @returns {void}
     */
    clearForm() {
      this.form = {
        author: {
          email: '',
          username: '',
        },
        content: '',
        title: '',
      }
    },
    /**
     * Изменяет список комментариев.
     * @param {Array} - массив объектов комментариев
     * @returns {void}
     */
    setList(comments) {
      this.list = comments
    },
  },
})
