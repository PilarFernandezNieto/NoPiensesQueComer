<script setup>
defineProps({
  variante: {
    type: String,
    default: 'primario',
    validator: (v) => ['primario', 'secundario', 'peligro', 'fantasma'].includes(v),
  },
  tamanio: {
    type: String,
    default: 'md',
    validator: (v) => ['sm', 'md', 'lg'].includes(v),
  },
  cargando: {
    type: Boolean,
    default: false,
  },
  disabled: {
    type: Boolean,
    default: false,
  },
  type: {
    type: String,
    default: 'button',
  },
})

const clases = {
  base: 'inline-flex items-center justify-center gap-2 font-medium rounded-lg border transition-colors cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed',
  tamanio: {
    sm: 'text-xs px-3 py-1.5',
    md: 'text-sm px-4 py-2',
    lg: 'text-base px-5 py-2.5',
  },
  variante: {
    primario: 'bg-primario text-white border-primario hover:bg-primario-claro',
    secundario: 'bg-superficie text-texto border-borde hover:bg-fondo',
    peligro: 'bg-red-600 text-white border-red-600 hover:bg-red-700',
    fantasma: 'bg-transparent text-texto-secundario border-transparent hover:bg-fondo',
  },
}
</script>

<template>
  <button
    :type="type"
    :disabled="disabled || cargando"
    :class="[clases.base, clases.tamanio[tamanio], clases.variante[variante]]"
  >
    <span v-if="cargando" class="material-icons-round animate-spin text-base">refresh</span>
    <slot />
  </button>
</template>
