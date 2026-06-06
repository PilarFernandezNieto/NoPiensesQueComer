import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const routes = [
  {
    path: '/login',
    name: 'login',
    component: () => import('@/views/auth/LoginView.vue'),
    meta: { publica: true },
  },
  {
    path: '/registro',
    name: 'registro',
    component: () => import('@/views/auth/RegistroView.vue'),
    meta: { publica: true },
  },
  {
    path: '/',
    component: () => import('@/layouts/AppLayout.vue'),
    children: [
      {
        path: '',
        name: 'menu-semanal',
        component: () => import('@/views/MenuSemanalView.vue'),
      },
      {
        path: 'recetas',
        name: 'recetas',
        component: () => import('@/views/recetas/RecetasView.vue'),
      },
      {
        path: 'recetas/crear',
        name: 'recetas-crear',
        component: () => import('@/views/recetas/RecetaFormView.vue'),
      },
      {
        path: 'recetas/:id/editar',
        name: 'recetas-editar',
        component: () => import('@/views/recetas/RecetaFormView.vue'),
      },
      {
        path: 'ingredientes',
        name: 'ingredientes',
        component: () => import('@/views/ingredientes/IngredientesView.vue'),
      },
      {
        path: 'categorias',
        name: 'categorias',
        component: () => import('@/views/ingredientes/CategoriasView.vue'),
      },
      {
        path: 'lista-compra',
        name: 'lista-compra',
        component: () => import('@/views/ListaCompraView.vue'),
      },
      {
        path: 'configuracion',
        name: 'configuracion',
        component: () => import('@/views/ConfiguracionView.vue'),
      },
    ],
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

router.beforeEach((to) => {
  const auth = useAuthStore()

  if (!to.meta.publica && !auth.estaAutenticado) {
    return { name: 'login' }
  }

  if (to.meta.publica && auth.estaAutenticado) {
    return { name: 'menu-semanal' }
  }
})

export default router
