<script setup>
import { useRouter, useRoute } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const router = useRouter()
const route = useRoute()
const auth = useAuthStore()

async function cerrarSesion() {
  await auth.logout()
  router.push({ name: 'login' })
}

const navegacion = [
  { nombre: 'Menú semanal', ruta: 'menu-semanal', icono: 'calendar_today' },
  { nombre: 'Lista de la compra', ruta: 'lista-compra', icono: 'shopping_basket' },
  { nombre: 'Recetas', ruta: 'recetas', icono: 'receipt_long' },
  { nombre: 'Ingredientes', ruta: 'ingredientes', icono: 'egg_alt' },
  { nombre: 'Categorías', ruta: 'categorias', icono: 'category' },
  { nombre: 'Configuración', ruta: 'configuracion', icono: 'tune' },
]
</script>

<template>
  <div class="flex min-h-screen bg-fondo">
    <!-- Sidebar desktop -->
    <aside
      class="hidden md:flex flex-col fixed top-0 left-0 h-screen w-56 bg-superficie border-r border-borde"
    >
      <div class="px-5 py-5 border-b border-borde">
        <div class="text-sm font-bold text-texto leading-snug">No Pienses<br />Qué Comer</div>
        <div class="text-xs text-texto-muted mt-1">Planificador semanal</div>
      </div>

      <nav class="flex-1 flex flex-col py-3">
        <router-link
          v-for="item in navegacion"
          :key="item.ruta"
          :to="{ name: item.ruta }"
          class="flex items-center gap-3 px-5 py-2.5 text-sm text-texto-secundario no-underline hover:bg-fondo transition-colors"
          :class="
            route.name === item.ruta
              ? 'text-primario font-medium bg-primario-fondo border-r-2 border-primario'
              : ''
          "
        >
          <span class="material-icons-round text-lg">{{ item.icono }}</span>
          {{ item.nombre }}
        </router-link>
      </nav>

      <div class="px-5 py-4 border-t border-borde">
        <div class="text-xs text-texto-secundario mb-2">{{ auth.usuario?.name }}</div>
        <button
          class="flex items-center gap-2 text-xs text-texto-secundario hover:text-texto transition-colors bg-transparent border-none cursor-pointer p-0"
          @click="cerrarSesion"
        >
          <span class="material-icons-round text-base">logout</span>
          Cerrar sesión
        </button>
      </div>
    </aside>

    <!-- Contenido principal -->
    <main class="flex-1 md:ml-56 min-h-screen pb-16 md:pb-0">
      <router-view />
    </main>

    <!-- Barra inferior móvil -->
    <nav
      class="md:hidden fixed bottom-0 left-0 right-0 bg-superficie border-t border-borde flex z-50"
    >
      <router-link
        v-for="item in navegacion.slice(0, 5)"
        :key="item.ruta"
        :to="{ name: item.ruta }"
        class="flex flex-col items-center gap-0.5 py-2 flex-1 text-[10px] text-texto-muted no-underline"
        :class="route.name === item.ruta ? 'text-primario' : ''"
      >
        <span class="material-icons-round text-2xl">{{ item.icono }}</span>
        {{ item.nombre }}
      </router-link>
    </nav>
  </div>
</template>
