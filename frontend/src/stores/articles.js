import { defineStore } from 'pinia'
import { i18n } from 'boot/i18n'
import { useCommentsStore } from 'stores/comments'
import axios from 'axios'
import notify from 'src/utils/helpers/notify'

const comments = useCommentsStore()

export const useArticlesStore = defineStore('articles', {
  state: () => ({
    form: {
      author_email: 'maxgoover@gmail.com',
      author_username: 'MaxGoover',
      content:
        '<p>Пользователь X под ником PatRyk <a href="https://twitter.com/Patrosi73/status/1789756239984890165" rel="noopener noreferrer nofollow">установил </a>Windows 11 на консоль Nintendo Switch. По его словам, у него получился «самый медленный компьютер в мире», что недалеко от правды: только загрузка рабочего стола занимает более двух минут.</p><p>Как <a href="https://www.windowslatest.com/2024/05/13/watch-dev-runs-windows-11-arm-on-nintendo-switch-using-qemu-linux-emulation/" rel="noopener noreferrer nofollow">уточняет </a>PatRyk, он использовал версию Windows 11 ARM с включённым KVM. Для начала он установил на SD-карту консоли Fedora Linux через Switchroot. По его словам, использование Switchroot-дистрибутива Fedora обязательно, потому что это единственная версия с поддержкой KVM.</p><p>После настройки Fedora он использовал <a href="https://gist.github.com/Vogtinator/293c4f90c5e92838f7e72610725905fd" rel="noopener noreferrer nofollow">скрипт </a>для запуска Windows 11 в эмуляторе QEMU, который ему пришлось модифицировать, чтобы он правильно работал со Switch. PatRyk выделил виртуальной машине 4 ядра и 3 ГБ ОЗУ, что близко к максимуму (у Switch всего 4 ГБ ОЗУ).</p>',
      title: 'Энтузиаст установил Windows 11 на Nintendo Switch',
    },
    isShowedCreateModal: false,
    list: [], // список статей
    selected: {}, // выбранная статья
  }),

  actions: {
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
    /**
     * Получает все комментарии к статье.
     * @param {Number} id
     * @returns {Promise}
     */
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
