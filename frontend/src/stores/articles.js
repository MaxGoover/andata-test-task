import { defineStore } from 'pinia'
import { i18n } from 'boot/i18n'
import { useCommentsStore } from 'stores/comments'
import axios from 'axios'
import notify from 'src/utils/helpers/notify'

const comments = useCommentsStore()

export const useArticlesStore = defineStore('articles', {
  state: () => ({
    form: {
      author_email: 'john_doe@gmail.com',
      author_username: 'John Doe',
      content: 'Большооооое содержание статьи',
      title: '',
    },
    isShowedCreateModal: false,
    list: [], // список статей
    selected: {}, // выбранная статья
  }),

  actions: {
    /**
     * Получает список статей.
     * @returns {Promise}
     */
    async index() {
      return axios
        .get('/api/articles')
        .then((response) => {
          this.setList(response.data.articles)
        })
        .catch(() => {
          notify.error(i18n.global.t('message.error.articles.index'))
        })
    },
    /**
     * Получает статью по её идентификатору.
     * @param {Number} id
     * @returns {Promise}
     */
    async show(id) {
      return axios
        .get(`/api/articles/${id}`)
        .then((response) => {
          this.setSelected(response.data.article)
          comments.setCount(response.data.countComments)
          comments.setList(response.data.comments)
        })
        .catch(() => {
          notify.error(i18n.global.t('message.error.articles.index'))
        })
    },
    /**
     * Сохраняет статью.
     * @returns {Promise}
     */
    async create() {
      return axios
        .post('/api/articles/create', this.form)
        .then(() => {
          this.clearForm()
          this.hideCreateModal()
        })
        .catch(() => {
          notify.error(i18n.global.t('message.error.articles.create'))
        })
    },
    async getComments(id) {
      return axios
        .get(`/api/articles/${id}/get-comments`)
        .then((response) => {
          comments.setCount(response.data.countComments)
          comments.setList(response.data.comments)
        })
        .catch(() => {
          notify.error(i18n.global.t('message.error.articles.getComments'))
        })
    },
    /**
     * Очищает форму статьи.
     * @returns {void}
     */
    clearForm() {
      this.form.author_email = ''
      this.form.author_username = ''
      this.form.content = ''
      this.form.title = ''
    },
    /**
     * Скрывает модальное окно создания статьи.
     * @returns {void}
     */
    hideCreateModal() {
      this.isShowedCreateModal = false
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
      this.selected = article
    },
    /**
     * Показывает модальное окно создания статьи.
     * @returns {void}
     */
    showCreateModal() {
      this.isShowedCreateModal = true
    },
  },
})
