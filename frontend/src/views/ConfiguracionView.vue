<script setup>
import { ref } from 'vue'
import AppTarjeta from '@/components/ui/AppTarjeta.vue'
import AppBoton from '@/components/ui/AppBoton.vue'
import AppModal from '@/components/ui/AppModal.vue'
import AppSelect from '@/components/ui/AppSelect.vue'
import AppInput from '@/components/ui/AppInput.vue'

const mostrarModalRestriccion = ref(false)
const mostrarModalRegla = ref(false)
const cargando = ref(false)

const formularioRestriccion = ref({
  ingrediente_id: '',
  ambito: '',
})

const formularioRegla = ref({
  tipo: '',
  dia_semana: '',
  valor: '',
})

const restricciones = ref([
  { id: 1, ingrediente: 'Lentejas', ambito: 'solo_cena' },
  { id: 2, ingrediente: 'Berenjena', ambito: 'siempre' },
])

const reglas = ref([])

const opcionesAmbito = [
  { valor: 'siempre', etiqueta: 'Siempre (nunca aparece)' },
  { valor: 'solo_comida', etiqueta: 'Solo en comidas' },
  { valor: 'solo_cena', etiqueta: 'Solo en cenas' },
]

const opcionesTipoRegla = [
  { valor: 'dia_sin_cocina', etiqueta: 'Día sin cocina' },
  { valor: 'taper_requerido', etiqueta: 'Táper requerido' },
  { valor: 'max_dias_cocina', etiqueta: 'Máximo días de cocina' },
]

const opcionesDia = [
  { valor: 0, etiqueta: 'Lunes' },
  { valor: 1, etiqueta: 'Martes' },
  { valor: 2, etiqueta: 'Miércoles' },
  { valor: 3, etiqueta: 'Jueves' },
  { valor: 4, etiqueta: 'Viernes' },
  { valor: 5, etiqueta: 'Sábado' },
  { valor: 6, etiqueta: 'Domingo' },
]

const etiquetaAmbito = {
  siempre: 'Nunca',
  solo_comida: 'Solo comidas',
  solo_cena: 'Solo cenas',
}

async function guardarRestriccion() {
  cargando.value = true
  try {
    mostrarModalRestriccion.value = false
  } finally {
    cargando.value = false
  }
}

async function guardarRegla() {
  cargando.value = true
  try {
    mostrarModalRegla.value = false
  } finally {
    cargando.value = false
  }
}
</script>

<template>
  <div class="p-4 md:p-6 max-w-2xl mx-auto">
    <div class="mb-6">
      <h1 class="text-xl font-bold text-texto">Configuración</h1>
      <p class="text-sm text-texto-muted mt-0.5">Restricciones y reglas del hogar</p>
    </div>

    <div class="flex flex-col gap-6">
      <div>
        <div class="flex items-center justify-between mb-3">
          <h2 class="text-sm font-medium text-texto">Restricciones de ingredientes</h2>
          <AppBoton variante="secundario" tamanio="sm" @click="mostrarModalRestriccion = true">
            <span class="material-icons-round text-sm">add</span>
            Añadir
          </AppBoton>
        </div>

        <AppTarjeta padding="none">
          <ul class="divide-y divide-borde">
            <li
              v-for="r in restricciones"
              :key="r.id"
              class="flex items-center justify-between px-4 py-3"
            >
              <div>
                <div class="text-sm font-medium text-texto">{{ r.ingrediente }}</div>
                <div class="text-xs text-texto-muted mt-0.5">{{ etiquetaAmbito[r.ambito] }}</div>
              </div>
              <button
                class="text-red-400 hover:text-red-600 transition-colors bg-transparent border-none cursor-pointer p-0"
              >
                <span class="material-icons-round text-base">delete_outline</span>
              </button>
            </li>
            <li
              v-if="restricciones.length === 0"
              class="px-4 py-6 text-center text-sm text-texto-muted"
            >
              No hay restricciones definidas
            </li>
          </ul>
        </AppTarjeta>
      </div>

      <div>
        <div class="flex items-center justify-between mb-3">
          <h2 class="text-sm font-medium text-texto">Reglas de planificación</h2>
          <AppBoton variante="secundario" tamanio="sm" @click="mostrarModalRegla = true">
            <span class="material-icons-round text-sm">add</span>
            Añadir
          </AppBoton>
        </div>

        <AppTarjeta padding="none">
          <ul class="divide-y divide-borde">
            <li v-if="reglas.length === 0" class="px-4 py-6 text-center text-sm text-texto-muted">
              No hay reglas definidas
            </li>
          </ul>
        </AppTarjeta>
      </div>
    </div>

    <AppModal
      v-if="mostrarModalRestriccion"
      titulo="Nueva restricción"
      @cerrar="mostrarModalRestriccion = false"
    >
      <div class="flex flex-col gap-4">
        <AppInput
          v-model="formularioRestriccion.ingrediente_id"
          label="Ingrediente"
          placeholder="Nombre del ingrediente"
        />
        <AppSelect
          v-model="formularioRestriccion.ambito"
          label="Restricción"
          :opciones="opcionesAmbito"
        />
      </div>
      <template #footer>
        <AppBoton variante="secundario" @click="mostrarModalRestriccion = false">Cancelar</AppBoton>
        <AppBoton :cargando="cargando" @click="guardarRestriccion">Guardar</AppBoton>
      </template>
    </AppModal>

    <AppModal v-if="mostrarModalRegla" titulo="Nueva regla" @cerrar="mostrarModalRegla = false">
      <div class="flex flex-col gap-4">
        <AppSelect
          v-model="formularioRegla.tipo"
          label="Tipo de regla"
          :opciones="opcionesTipoRegla"
        />
        <AppSelect
          v-if="
            formularioRegla.tipo === 'dia_sin_cocina' || formularioRegla.tipo === 'taper_requerido'
          "
          v-model="formularioRegla.dia_semana"
          label="Día de la semana"
          :opciones="opcionesDia"
        />
        <AppInput
          v-if="formularioRegla.tipo === 'max_dias_cocina'"
          v-model="formularioRegla.valor"
          label="Número máximo de días"
          tipo="number"
          placeholder="3"
        />
      </div>
      <template #footer>
        <AppBoton variante="secundario" @click="mostrarModalRegla = false">Cancelar</AppBoton>
        <AppBoton :cargando="cargando" @click="guardarRegla">Guardar</AppBoton>
      </template>
    </AppModal>
  </div>
</template>
