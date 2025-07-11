import type { RouteRecordRaw } from 'vue-router'

const routes: RouteRecordRaw[] = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      {
        path: '',
        component: () => import('pages/DashboardPage.vue'),
        name: 'dashboard',
      },
      {
        path: 'expenses',
        component: () => import('pages/ExpensesPage.vue'),
        name: 'expenses',
      },
      {
        path: 'settings',
        component: () => import('pages/Settings.vue'),
        name: 'settings',
      },
    ],
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue'),
  },
]

export default routes
