import { $t } from 'boot/i18n'
import { cloneDeep } from 'lodash'
import { defineStore } from 'pinia'
import axios from 'axios'
import notify from 'src/utils/helpers/notify'
import routesApi from 'src/utils/consts/routes/api'

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
    isShowedDeleteModal: false,
    isShowedUpdateModal: false,
    list: [], // список комментариев
  }),

  actions: {
    /**
     * Сохраняет комментарий.
     * @returns {Promise}
     */
    async create() {
      return axios
        .post(routesApi.COMMENT.CREATE, this.form)
        .then(() => {
          notify.success($t('message.success.comment.create'))
        })
        .catch(() => {
          notify.error($t('message.error.comment.create'))
        })
    },

    /**
     * Удаляет комментарий по его идентификатору.
     * @param {Number} id
     * @returns {Promise}
     */
    async delete(id) {
      return axios.delete(routesApi.COMMENT.DELETE(id)).catch(() => {
        notify.error($t('message.error.comment.delete'))
      })
    },
    /**
     * Редактирует комментарий.
     * @returns {Promise}
     */
    async update(id) {
      return axios.put(routesApi.COMMENT.UPDATE(id), this.form).catch(() => {
        notify.error($t('message.error.comment.update'))
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
     * Очищает выбранный комментарий.
     * @returns {void}
     */
    clearSelected() {
      this.selected = {}
    },
    /**
     * Скрывает модальное окно удаления комментария.
     * @returns {void}
     */
    hideDeleteModal() {
      this.isShowedDeleteModal = false
    },
    /**
     * Скрывает модальное окно редактирования комментария.
     * @returns {void}
     */
    hideUpdateModal() {
      this.isShowedUpdateModal = false
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
     * Изменяет данные формы комментария.
     * @param {Object} - объект комментария
     * @returns {void}
     */
    setForm(comment) {
      this.form = cloneDeep(comment)
    },
    /**
     * Изменяет список комментариев.
     * @param {Array} comments
     * @returns {void}
     */
    setList(comments) {
      this.list = comments
    },
    /**
     * Выбирает комментарий.
     * @param {Object} - объект комментария
     * @returns {void}
     */
    setSelected(comment) {
      this.selected = cloneDeep(comment)
    },
    /**
     * Показывает модальное окно удаления комментария.
     * @returns {void}
     */
    showDeleteModal() {
      this.isShowedDeleteModal = true
    },
    /**
     * Показывает модальное окно редактирования комментария.
     * @returns {void}
     */
    showUpdateModal() {
      this.isShowedUpdateModal = true
    },
  },
})
