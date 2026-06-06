<script setup>
defineProps({
  variante: {
    type: String,
    default: 'default',
    validator: (v) => ['default', 'primario', 'success', 'warning', 'peligro'].includes(v),
  },
})

const clases = {
  default: 'bg-fondo text-texto-secundario border-borde',
  primario: 'bg-primario-fondo text-primario border-primario-fondo',
  success: 'bg-green-100 text-green-800 border-green-100',
  warning: 'bg-amber-100 text-amber-800 border-amber-100',
  peligro: 'bg-red-100 text-red-800 border-red-100',
}
</script>

<template>
  <span
    class="inline-flex items-center gap-1 text-xs font-medium px-2 py-0.5 rounded-full border"
    :class="clases[variante]"
  >
    <slot />
  </span>
</template>
