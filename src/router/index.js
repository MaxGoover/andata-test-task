import { createRouter, createWebHistory } from 'vue-router'
import { route } from 'quasar/wrappers'
import routes from './routes'

export default route(function (/* { store, ssrContext } */) {
  const Router = createRouter({
    scrollBehavior: () => ({ left: 0, top: 0 }),
    routes,
    history: createWebHistory(process.env.VUE_ROUTER_BASE),
  })

  return Router
})
