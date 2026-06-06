<script setup>
import { ref } from 'vue'
import AppTarjeta from '@/components/ui/AppTarjeta.vue'
import AppBoton from '@/components/ui/AppBoton.vue'
import AppBadge from '@/components/ui/AppBadge.vue'

const recetas = ref([
  {
    id: 1,
    nombre: 'Tortilla de patatas',
    tipo_comida: 'ambas',
    tiempo_prep_min: 30,
    apta_taper: true,
    apta_congelar: false,
    genera_sobras: true,
  },
  {
    id: 2,
    nombre: 'Pollo al horno',
    tipo_comida: 'ambas',
    tiempo_prep_min: 50,
    apta_taper: true,
    apta_congelar: true,
    genera_sobras: true,
  },
])

const etiquetaTipo = {
  comida: 'Comida',
  cena: 'Cena',
  ambas: 'Comida y cena',
}
</script>

<template>
  <div class="p-4 md:p-6">
    <div class="flex items-center justify-between mb-6">
      <div>
        <h1 class="text-xl font-bold text-texto">Recetas</h1>
        <p class="text-sm text-texto-muted mt-0.5">{{ recetas.length }} recetas disponibles</p>
      </div>
      <AppBoton :to="{ name: 'recetas-crear' }">
        <span class="material-icons-round text-base">add</span>
        Nueva receta
      </AppBoton>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
      <AppTarjeta
        v-for="receta in recetas"
        :key="receta.id"
        class="cursor-pointer hover:border-primario transition-colors"
      >
        <div class="flex items-start justify-between gap-2 mb-3">
          <h2 class="text-sm font-medium text-texto">{{ receta.nombre }}</h2>
          <router-link :to="{ name: 'recetas-editar', params: { id: receta.id } }">
            <span class="material-icons-round text-texto-muted text-base hover:text-texto"
              >edit</span
            >
          </router-link>
        </div>

        <div class="flex items-center gap-1 text-xs text-texto-muted mb-3">
          <span class="material-icons-round text-sm">schedule</span>
          {{ receta.tiempo_prep_min }} min · {{ etiquetaTipo[receta.tipo_comida] }}
        </div>

        <div class="flex gap-1.5 flex-wrap">
          <AppBadge v-if="receta.apta_taper" variante="primario">Táper</AppBadge>
          <AppBadge v-if="receta.apta_congelar" variante="primario">Congelar</AppBadge>
          <AppBadge v-if="receta.genera_sobras" variante="default">Sobras</AppBadge>
        </div>
      </AppTarjeta>
    </div>
  </div>
</template>
