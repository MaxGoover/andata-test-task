import { $t } from 'boot/i18n'
import { cloneDeep } from 'lodash'
import { defineStore } from 'pinia'
import { useCommentsStore } from 'stores/comments'
import axios from 'axios'
import notify from 'src/utils/helpers/notify'
import routesApi from 'src/utils/consts/routes/api'

const comments = useCommentsStore()

export const useArticlesStore = defineStore('articles', {
  state: () => ({
    form: {
      id: null,
      author_email: '',
      author_username: '',
      content: '',
      title: '',
    },
    isShowedCreateModal: false,
    isShowedDeleteModal: false,
    isShowedUpdateModal: false,
    list: [], // список статей
    selected: {}, // выбранная статья
  }),

  actions: {
    /**
     * Сохраняет статью.
     * @returns {Promise}
     */
    async create() {
      return axios.post(routesApi.ARTICLE.CREATE, this.form).catch(() => {
        notify.error($t('message.error.article.create'))
      })
    },
    /**
     * Удаляет статью по её идентификатору.
     * @param {Number} id
     * @returns {Promise}
     */
    async delete(id) {
      return axios.delete(routesApi.ARTICLE.DELETE(id)).catch(() => {
        notify.error($t('message.error.article.delete'))
      })
    },
    /**
     * Получает все комментарии к статье.
     * @param {Number} id
     * @returns {Promise}
     */
    async getComments(id) {
      return axios
        .get(routesApi.ARTICLE.GET_COMMENTS(id))
        .then((response) => {
          comments.setCount(response.data.countComments)
          comments.setList(response.data.comments)
        })
        .catch(() => {
          notify.error($t('message.error.article.getComments'))
        })
    },
    /**
     * Получает список статей.
     * @returns {Promise}
     */
    async index() {
      return axios
        .get(routesApi.ARTICLE.INDEX)
        .then((response) => {
          this.setList(response.data.articles)
        })
        .catch(() => {
          notify.error($t('message.error.article.index'))
        })
    },
    /**
     * Получает статью по её идентификатору.
     * @param {Number} id
     * @returns {Promise}
     */
    async show(id) {
      return axios
        .get(routesApi.ARTICLE.SHOW(id))
        .then((response) => {
          this.setSelected(response.data.article)
          comments.setCount(response.data.countComments)
          comments.setList(response.data.comments)
        })
        .catch(() => {
          notify.error($t('message.error.article.index'))
        })
    },
    /**
     * Редактирует статью.
     * @returns {Promise}
     */
    async update(id) {
      return axios.put(routesApi.ARTICLE.UPDATE(id), this.form).catch(() => {
        notify.error($t('message.error.article.update'))
      })
    },
    /**
     * Очищает форму статьи.
     * @returns {void}
     */
    clearForm() {
      this.form.id = null
      this.form.author_email = ''
      this.form.author_username = ''
      this.form.content = ''
      this.form.title = ''
    },
    /**
     * Очищает выбранную (отображаемую) статью.
     * @returns {void}
     */
    clearSelected() {
      this.selected = {}
    },
    /**
     * Скрывает модальное окно создания статьи.
     * @returns {void}
     */
    hideCreateModal() {
      this.isShowedCreateModal = false
    },
    /**
     * Скрывает модальное окно удаления статьи.
     * @returns {void}
     */
    hideDeleteModal() {
      this.isShowedDeleteModal = false
    },
    /**
     * Скрывает модальное окно редактирования статьи.
     * @returns {void}
     */
    hideUpdateModal() {
      this.isShowedUpdateModal = false
    },
    /**
     * Изменяет данные формы статьи.
     * @param {Object} - объект статьи
     * @returns {void}
     */
    setForm(article) {
      this.form = cloneDeep(article)
    },
    /**
     * Изменяет список статей.
     * @param {Array} - массив объектов статей
     * @returns {void}
     */
    setList(articles) {
      this.list = articles
    },
    /**
     * Выбирает статью.
     * @param {Object} - объект статьи
     * @returns {void}
     */
    setSelected(article) {
      this.selected = cloneDeep(article)
    },
    /**
     * Показывает модальное окно создания статьи.
     * @returns {void}
     */
    showCreateModal() {
      this.isShowedCreateModal = true
    },
    /**
     * Показывает модальное окно удаления статьи.
     * @returns {void}
     */
    showDeleteModal() {
      this.isShowedDeleteModal = true
    },
    /**
     * Показывает модальное окно редактирования статьи.
     * @returns {void}
     */
    showUpdateModal() {
      this.isShowedUpdateModal = true
    },
  },
})
