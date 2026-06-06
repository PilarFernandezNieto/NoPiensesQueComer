<script setup>
import { onMounted, onUnmounted } from 'vue'

defineProps({
  titulo: {
    type: String,
    default: '',
  },
  tamanio: {
    type: String,
    default: 'md',
    validator: (v) => ['sm', 'md', 'lg', 'xl'].includes(v),
  },
})

const emit = defineEmits(['cerrar'])

const clasesTamanio = {
  sm: 'max-w-sm',
  md: 'max-w-lg',
  lg: 'max-w-2xl',
  xl: 'max-w-4xl',
}

function cerrar() {
  emit('cerrar')
}

function onTecla(e) {
  if (e.key === 'Escape') cerrar()
}

onMounted(() => {
  document.addEventListener('keydown', onTecla)
  document.body.style.overflow = 'hidden'
})

onUnmounted(() => {
  document.removeEventListener('keydown', onTecla)
  document.body.style.overflow = ''
})
</script>

<template>
  <Teleport to="body">
    <div
      class="fixed inset-0 z-50 flex items-center justify-center p-4"
      role="dialog"
      aria-modal="true"
    >
      <!-- Fondo oscuro -->
      <div class="absolute inset-0 bg-black/40" @click="cerrar" />

      <!-- Panel -->
      <div
        class="relative w-full bg-superficie rounded-xl border border-borde flex flex-col max-h-[90vh]"
        :class="clasesTamanio[tamanio]"
      >
        <!-- Cabecera -->
        <div class="flex items-center justify-between px-5 py-4 border-b border-borde shrink-0">
          <h2 class="text-base font-medium text-texto">{{ titulo }}</h2>
          <button
            class="text-texto-muted hover:text-texto transition-colors bg-transparent border-none cursor-pointer p-0"
            @click="cerrar"
          >
            <span class="material-icons-round text-xl">close</span>
          </button>
        </div>

        <!-- Contenido -->
        <div class="overflow-y-auto flex-1 px-5 py-4">
          <slot />
        </div>

        <!-- Footer -->
        <div
          v-if="$slots.footer"
          class="flex items-center justify-end gap-2 px-5 py-4 border-t border-borde shrink-0"
        >
          <slot name="footer" />
        </div>
      </div>
    </div>
  </Teleport>
</template>
