<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import AppInput from '@/components/ui/AppInput.vue'
import AppSelect from '@/components/ui/AppSelect.vue'
import AppToggle from '@/components/ui/AppToggle.vue'
import AppBoton from '@/components/ui/AppBoton.vue'
import AppTarjeta from '@/components/ui/AppTarjeta.vue'

const router = useRouter()

const formulario = ref({
  nombre: '',
  preparacion: '',
  tiempo_prep_min: '',
  raciones: 2,
  tipo_comida: '',
  apta_taper: true,
  apta_congelar: false,
  genera_sobras: false,
  raciones_sobra: 0,
})

const errores = ref({})
const cargando = ref(false)

const opcionesTipo = [
  { valor: 'comida', etiqueta: 'Comida' },
  { valor: 'cena', etiqueta: 'Cena' },
  { valor: 'ambas', etiqueta: 'Comida y cena' },
]

async function enviar() {
  cargando.value = true
  try {
    router.push({ name: 'recetas' })
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
  <div class="p-4 md:p-6 max-w-2xl mx-auto">
    <div class="flex items-center gap-3 mb-6">
      <button
        class="text-texto-muted hover:text-texto transition-colors bg-transparent border-none cursor-pointer p-0"
        @click="router.back()"
      >
        <span class="material-icons-round">arrow_back</span>
      </button>
      <h1 class="text-xl font-bold text-texto">Nueva receta</h1>
    </div>

    <div class="flex flex-col gap-4">
      <AppTarjeta>
        <div class="flex flex-col gap-4">
          <AppInput
            v-model="formulario.nombre"
            label="Nombre"
            placeholder="Pollo al horno"
            :error="errores.nombre?.[0]"
            requerido
          />

          <div class="flex flex-col gap-1">
            <label class="text-xs font-medium text-texto-secundario">Preparación</label>
            <textarea
              v-model="formulario.preparacion"
              rows="4"
              placeholder="Describe los pasos..."
              class="w-full text-sm text-texto bg-superficie border border-borde rounded-lg px-3 py-2 outline-none transition-colors placeholder:text-texto-muted focus:border-primario resize-none"
            />
          </div>

          <div class="grid grid-cols-2 gap-4">
            <AppInput
              v-model="formulario.tiempo_prep_min"
              label="Tiempo (minutos)"
              tipo="number"
              placeholder="30"
              :error="errores.tiempo_prep_min?.[0]"
            />
            <AppInput
              v-model="formulario.raciones"
              label="Raciones"
              tipo="number"
              placeholder="2"
              :error="errores.raciones?.[0]"
            />
          </div>

          <AppSelect
            v-model="formulario.tipo_comida"
            label="Tipo de comida"
            :opciones="opcionesTipo"
            :error="errores.tipo_comida?.[0]"
            requerido
          />
        </div>
      </AppTarjeta>

      <AppTarjeta>
        <div class="flex flex-col gap-4">
          <h2 class="text-sm font-medium text-texto">Opciones</h2>
          <AppToggle
            v-model="formulario.apta_taper"
            label="Apta para táper"
            descripcion="Se puede llevar al trabajo"
          />
          <AppToggle
            v-model="formulario.apta_congelar"
            label="Apta para congelar"
            descripcion="Se puede guardar en el congelador"
          />
          <AppToggle
            v-model="formulario.genera_sobras"
            label="Genera sobras"
            descripcion="Produce raciones extra"
          />
          <AppInput
            v-if="formulario.genera_sobras"
            v-model="formulario.raciones_sobra"
            label="Raciones de sobra"
            tipo="number"
            placeholder="2"
          />
        </div>
      </AppTarjeta>

      <div class="flex gap-3 justify-end">
        <AppBoton variante="secundario" @click="router.back()"> Cancelar </AppBoton>
        <AppBoton :cargando="cargando" @click="enviar"> Guardar receta </AppBoton>
      </div>
    </div>
  </div>
</template>
