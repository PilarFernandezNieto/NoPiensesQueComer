<script setup>
import { ref } from 'vue'
import AppTarjeta from '@/components/ui/AppTarjeta.vue'
import AppBoton from '@/components/ui/AppBoton.vue'
import AppModal from '@/components/ui/AppModal.vue'
import AppInput from '@/components/ui/AppInput.vue'
import AppSelect from '@/components/ui/AppSelect.vue'

const mostrarModal = ref(false)
const cargando = ref(false)
const errores = ref({})

const formulario = ref({
  nombre: '',
  categoria_id: '',
})

const categorias = ref([
  { valor: 1, etiqueta: 'Proteínas' },
  { valor: 2, etiqueta: 'Verduras' },
  { valor: 3, etiqueta: 'Bases' },
])

const ingredientes = ref([
  { id: 1, nombre: 'Pollo', categoria: 'Proteínas' },
  { id: 2, nombre: 'Huevos', categoria: 'Proteínas' },
  { id: 3, nombre: 'Tomate', categoria: 'Verduras' },
])

function abrirModal() {
  formulario.value = { nombre: '', categoria_id: '' }
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
        <h1 class="text-xl font-bold text-texto">Ingredientes</h1>
        <p class="text-sm text-texto-muted mt-0.5">{{ ingredientes.length }} ingredientes</p>
      </div>
      <AppBoton @click="abrirModal">
        <span class="material-icons-round text-base">add</span>
        Nuevo
      </AppBoton>
    </div>

    <AppTarjeta padding="none">
      <ul class="divide-y divide-borde">
        <li
          v-for="ingrediente in ingredientes"
          :key="ingrediente.id"
          class="flex items-center justify-between px-4 py-3 hover:bg-fondo transition-colors"
        >
          <div>
            <div class="text-sm font-medium text-texto">{{ ingrediente.nombre }}</div>
            <div class="text-xs text-texto-muted mt-0.5">{{ ingrediente.categoria }}</div>
          </div>
          <button
            class="text-texto-muted hover:text-texto transition-colors bg-transparent border-none cursor-pointer p-0"
          >
            <span class="material-icons-round text-base">edit</span>
          </button>
        </li>
      </ul>
    </AppTarjeta>

    <AppModal v-if="mostrarModal" titulo="Nuevo ingrediente" @cerrar="mostrarModal = false">
      <div class="flex flex-col gap-4">
        <AppInput
          v-model="formulario.nombre"
          label="Nombre"
          placeholder="Pollo"
          :error="errores.nombre?.[0]"
          requerido
        />
        <AppSelect
          v-model="formulario.categoria_id"
          label="Categoría"
          :opciones="categorias"
          :error="errores.categoria_id?.[0]"
          requerido
        />
      </div>
      <template #footer>
        <AppBoton variante="secundario" @click="mostrarModal = false">Cancelar</AppBoton>
        <AppBoton :cargando="cargando" @click="guardar">Guardar</AppBoton>
      </template>
    </AppModal>
  </div>
</template>
