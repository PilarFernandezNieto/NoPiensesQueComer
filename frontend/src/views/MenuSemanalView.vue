<script setup>
import { ref } from 'vue'
import AppBoton from '@/components/ui/AppBoton.vue'
import TarjetaDia from '@/components/TarjetaDia.vue'

const dias = ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom']
const diaSeleccionado = ref(0)

const menu = ref([
  {
    comida: { nombre: 'Pollo al horno', apta_taper: true, apta_congelar: true, es_sobra: false },
    cena: {
      nombre: 'Tortilla de patatas',
      apta_taper: false,
      apta_congelar: false,
      es_sobra: false,
    },
  },
  {
    comida: { nombre: 'Arroz con pollo', apta_taper: true, apta_congelar: false, es_sobra: true },
    cena: { nombre: 'Salmorejo', apta_taper: true, apta_congelar: false, es_sobra: false },
  },
  {
    comida: { nombre: 'Pasta con carne', apta_taper: true, apta_congelar: true, es_sobra: false },
    cena: { nombre: 'Merluza al horno', apta_taper: false, apta_congelar: false, es_sobra: false },
  },
  {
    comida: { nombre: 'Ensaladilla rusa', apta_taper: true, apta_congelar: false, es_sobra: false },
    cena: {
      nombre: 'Lentejas con verduras',
      apta_taper: false,
      apta_congelar: true,
      es_sobra: false,
    },
  },
  {
    comida: { nombre: 'Pollo al horno', apta_taper: true, apta_congelar: true, es_sobra: true },
    cena: { nombre: 'Calabacín relleno', apta_taper: false, apta_congelar: false, es_sobra: false },
  },
  {
    comida: {
      nombre: 'Tortilla de patatas',
      apta_taper: false,
      apta_congelar: false,
      es_sobra: false,
    },
    cena: { nombre: 'Salmorejo', apta_taper: true, apta_congelar: false, es_sobra: false },
  },
  {
    comida: { nombre: 'Arroz con pollo', apta_taper: true, apta_congelar: false, es_sobra: false },
    cena: {
      nombre: 'Ensalada de garbanzos',
      apta_taper: false,
      apta_congelar: false,
      es_sobra: false,
    },
  },
])
</script>

<template>
  <div class="p-4 md:p-6">
    <div class="flex items-center justify-between mb-6">
      <div>
        <h1 class="text-xl font-bold text-texto">Menú semanal</h1>
        <p class="text-sm text-texto-muted mt-0.5">Semana del 2 al 8 de junio</p>
      </div>
      <AppBoton variante="secundario">
        <span class="material-icons-round text-base">autorenew</span>
        Regenerar
      </AppBoton>
    </div>

    <div class="flex gap-2 overflow-x-auto pb-2 mb-4">
      <button
        v-for="(dia, i) in dias"
        :key="i"
        class="shrink-0 px-3 py-1.5 rounded-full text-xs font-medium border transition-colors"
        :class="
          diaSeleccionado === i
            ? 'bg-primario text-white border-primario'
            : 'bg-superficie text-texto-secundario border-borde hover:border-primario'
        "
        @click="diaSeleccionado = i"
      >
        {{ dia }}
      </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-7 gap-3">
      <TarjetaDia
        v-for="(dia, i) in dias"
        :key="i"
        :dia="dia"
        :comida="menu[i].comida"
        :cena="menu[i].cena"
        :seleccionado="diaSeleccionado === i"
        :es-hoy="i === 0"
        @seleccionar="diaSeleccionado = i"
      />
    </div>
  </div>
</template>
