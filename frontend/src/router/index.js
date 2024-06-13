import { createRouter, createWebHistory } from 'vue-router'
import { route } from 'quasar/wrappers'
import routes from 'src/router/routes'

export default route(function (/* { store, ssrContext } */) {
  const Router = createRouter({
    history: createWebHistory(process.env.VUE_ROUTER_BASE),
    routes,
    scrollBehavior: () => ({ left: 0, top: 0 }),
  })

  return Router
})
