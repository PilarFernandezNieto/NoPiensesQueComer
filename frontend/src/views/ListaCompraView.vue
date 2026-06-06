<script setup>
import { ref } from 'vue'
import AppTarjeta from '@/components/ui/AppTarjeta.vue'
import AppBoton from '@/components/ui/AppBoton.vue'

const categorias = ref([
  {
    nombre: 'Proteínas',
    items: [
      { id: 1, nombre: 'Pollo', cantidad: null, unidad: null, marcado: false },
      { id: 2, nombre: 'Huevos', cantidad: null, unidad: null, marcado: false },
    ],
  },
  {
    nombre: 'Verduras',
    items: [
      { id: 3, nombre: 'Tomate', cantidad: null, unidad: null, marcado: false },
      { id: 4, nombre: 'Patata', cantidad: null, unidad: null, marcado: true },
    ],
  },
])

function toggleItem(item) {
  item.marcado = !item.marcado
}
</script>

<template>
  <div class="p-4 md:p-6">
    <div class="flex items-center justify-between mb-6">
      <div>
        <h1 class="text-xl font-bold text-texto">Lista de la compra</h1>
        <p class="text-sm text-texto-muted mt-0.5">Semana del 2 al 8 de junio</p>
      </div>
      <AppBoton variante="secundario">
        <span class="material-icons-round text-base">refresh</span>
        Regenerar
      </AppBoton>
    </div>

    <div class="flex flex-col gap-4">
      <AppTarjeta v-for="categoria in categorias" :key="categoria.nombre" padding="none">
        <div class="px-4 py-3 border-b border-borde">
          <h2 class="text-sm font-medium text-texto">{{ categoria.nombre }}</h2>
        </div>
        <ul class="divide-y divide-borde">
          <li
            v-for="item in categoria.items"
            :key="item.id"
            class="flex items-center gap-3 px-4 py-3 cursor-pointer hover:bg-fondo transition-colors"
            @click="toggleItem(item)"
          >
            <div
              class="w-5 h-5 rounded-full border-2 flex items-center justify-center shrink-0 transition-colors"
              :class="item.marcado ? 'bg-primario border-primario' : 'border-borde'"
            >
              <span
                v-if="item.marcado"
                class="material-icons-round text-white"
                style="font-size: 12px"
                >check</span
              >
            </div>
            <span
              class="text-sm flex-1"
              :class="item.marcado ? 'line-through text-texto-muted' : 'text-texto'"
            >
              {{ item.nombre }}
            </span>
            <span v-if="item.cantidad" class="text-xs text-texto-muted">
              {{ item.cantidad }} {{ item.unidad }}
            </span>
          </li>
        </ul>
      </AppTarjeta>
    </div>
  </div>
</template>
