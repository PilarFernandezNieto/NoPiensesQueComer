<script setup>
import AppBadge from '@/components/ui/AppBadge.vue'

defineProps({
  dia: {
    type: String,
    required: true,
  },
  comida: {
    type: Object,
    default: null,
  },
  cena: {
    type: Object,
    default: null,
  },
  seleccionado: {
    type: Boolean,
    default: false,
  },
  esHoy: {
    type: Boolean,
    default: false,
  },
})

defineEmits(['seleccionar'])
</script>

<template>
  <div
    class="bg-superficie border rounded-xl overflow-hidden cursor-pointer transition-colors"
    :class="seleccionado ? 'border-primario border-2' : 'border-borde hover:border-primario'"
    @click="$emit('seleccionar')"
  >
    <!-- Cabecera del día -->
    <div class="px-3 py-2.5 border-b border-borde flex items-center justify-between">
      <div class="text-xs uppercase tracking-wide text-texto-muted font-medium">{{ dia }}</div>
      <span
        v-if="esHoy"
        class="text-xs bg-primario-fondo text-primario px-2 py-0.5 rounded-full font-medium"
      >
        Hoy
      </span>
    </div>

    <!-- Comida -->
    <div class="px-3 py-2.5 border-b border-borde">
      <div class="flex items-center gap-1 text-xs text-primario font-medium mb-1">
        <span class="material-icons-round text-xs">wb_sunny</span>
        Comida
      </div>
      <div class="text-xs font-medium text-texto">
        {{ comida?.nombre ?? 'Sin planificar' }}
      </div>
      <div v-if="comida" class="flex gap-1 mt-1.5 flex-wrap">
        <AppBadge v-if="comida.apta_taper" variante="primario">Táper</AppBadge>
        <AppBadge v-if="comida.apta_congelar" variante="primario">Congelar</AppBadge>
        <AppBadge v-if="comida.es_sobra" variante="default">Sobra</AppBadge>
      </div>
    </div>

    <!-- Cena -->
    <div class="px-3 py-2.5">
      <div class="flex items-center gap-1 text-xs text-texto-muted font-medium mb-1">
        <span class="material-icons-round text-xs">nightlight_round</span>
        Cena
      </div>
      <div class="text-xs font-medium text-texto">
        {{ cena?.nombre ?? 'Sin planificar' }}
      </div>
      <div v-if="cena" class="flex gap-1 mt-1.5 flex-wrap">
        <AppBadge v-if="cena.apta_taper" variante="primario">Táper</AppBadge>
        <AppBadge v-if="cena.apta_congelar" variante="primario">Congelar</AppBadge>
        <AppBadge v-if="cena.es_sobra" variante="default">Sobra</AppBadge>
      </div>
    </div>
  </div>
</template>
