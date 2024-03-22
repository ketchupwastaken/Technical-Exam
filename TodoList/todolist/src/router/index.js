import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import edit from '../components/edit.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/add',
      name: 'add',
      component: () => import('../components/HelloWorld.vue')
    },
    {
      path: '/:id/edit',
      name: 'edit',
      component: edit
    }
  ]
})

export default router
