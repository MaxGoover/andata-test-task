import { defineStore } from 'pinia'

export const useLoadersStore = defineStore('loaders', {
  state: () => ({
    isShowedLoader: false,
  }),

  actions: {
    /**
     * Скрывает лоадер (общий).
     * @returns {void}
     */
    hideLoader() {
      this.isShowedLoader = false
    },
    /**
     * Показывает лоадер (общий).
     * @returns {void}
     */
    showLoader() {
      this.isShowedLoader = true
    },
  },
})
