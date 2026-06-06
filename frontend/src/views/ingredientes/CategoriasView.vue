<script setup>
import { ref } from 'vue'
import AppTarjeta from '@/components/ui/AppTarjeta.vue'
import AppBoton from '@/components/ui/AppBoton.vue'
import AppModal from '@/components/ui/AppModal.vue'
import AppInput from '@/components/ui/AppInput.vue'

const mostrarModal = ref(false)
const cargando = ref(false)
const errores = ref({})

const formulario = ref({
  nombre: '',
  orden: '',
})

const categorias = ref([
  { id: 1, nombre: 'Proteínas', orden: 1 },
  { id: 2, nombre: 'Bases', orden: 2 },
  { id: 3, nombre: 'Verduras', orden: 3 },
  { id: 4, nombre: 'Lácteos', orden: 4 },
  { id: 5, nombre: 'Conservas', orden: 5 },
  { id: 6, nombre: 'Condimentos', orden: 6 },
  { id: 7, nombre: 'Frescos', orden: 7 },
])

function abrirModal() {
  formulario.value = { nombre: '', orden: '' }
  errores.value = {}
  mostrarModal.value = true
}

async function guardar() {
  cargando.value = true
  try {
    mostrarModal.value = false
  } catch (e) {
    if (e.response?.status === 422) {
      errores.value = e.response.data.errors || {}
    }
  } finally {
    cargando.value = false
  }
}
</script>

<template>
  <div class="p-4 md:p-6">
    <div class="flex items-center justify-between mb-6">
      <div>
        <h1 class="text-xl font-bold text-texto">Categorías</h1>
        <p class="text-sm text-texto-muted mt-0.5">{{ categorias.length }} categorías</p>
      </div>
      <AppBoton @click="abrirModal">
        <span class="material-icons-round text-base">add</span>
        Nueva
      </AppBoton>
    </div>

    <AppTarjeta padding="none">
      <ul class="divide-y divide-borde">
        <li
          v-for="categoria in categorias"
          :key="categoria.id"
          class="flex items-center justify-between px-4 py-3 hover:bg-fondo transition-colors"
        >
          <div class="flex items-center gap-3">
            <span class="text-xs text-texto-muted w-4 text-right">{{ categoria.orden }}</span>
            <span class="text-sm font-medium text-texto">{{ categoria.nombre }}</span>
          </div>
          <button
            class="text-texto-muted hover:text-texto transition-colors bg-transparent border-none cursor-pointer p-0"
          >
            <span class="material-icons-round text-base">edit</span>
          </button>
        </li>
      </ul>
    </AppTarjeta>

    <AppModal v-if="mostrarModal" titulo="Nueva categoría" @cerrar="mostrarModal = false">
      <div class="flex flex-col gap-4">
        <AppInput
          v-model="formulario.nombre"
          label="Nombre"
          placeholder="Proteínas"
          :error="errores.nombre?.[0]"
          requerido
        />
        <AppInput
          v-model="formulario.orden"
          label="Orden"
          tipo="number"
          placeholder="1"
          :error="errores.orden?.[0]"
        />
      </div>
      <template #footer>
        <AppBoton variante="secundario" @click="mostrarModal = false">Cancelar</AppBoton>
        <AppBoton :cargando="cargando" @click="guardar">Guardar</AppBoton>
      </template>
    </AppModal>
  </div>
</template>
