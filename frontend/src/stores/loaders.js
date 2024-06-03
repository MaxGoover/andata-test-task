import { defineStore } from 'pinia'

export const useLoadersStore = defineStore('loaders', {
  state: () => ({
    isShowedLoader: false,
  }),

  actions: {
    hideLoader() {
      this.isShowedLoader = false
    },
    showLoader() {
      this.isShowedLoader = true
    },
  },
})
