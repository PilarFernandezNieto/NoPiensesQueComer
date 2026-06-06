<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import AppInput from '@/components/ui/AppInput.vue'
import AppBoton from '@/components/ui/AppBoton.vue'

const router = useRouter()
const auth = useAuthStore()

const formulario = ref({
  email: '',
  password: '',
})

const errores = ref({})
const cargando = ref(false)
const errorGeneral = ref('')

async function enviar() {
  errores.value = {}
  errorGeneral.value = ''
  cargando.value = true

  try {
    await auth.login(formulario.value)
    router.push({ name: 'menu-semanal' })
  } catch (e) {
    if (e.response?.status === 422) {
      errores.value = e.response.data.errors || {}
    } else {
      errorGeneral.value = 'Credenciales incorrectas. Inténtalo de nuevo.'
    }
  } finally {
    cargando.value = false
  }
}
</script>

<template>
  <div class="min-h-screen bg-fondo flex items-center justify-center p-4">
    <div class="w-full max-w-sm">
      <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-texto leading-snug">No Pienses<br />Qué Comer</h1>
        <p class="text-sm text-texto-muted mt-2">Planificador semanal</p>
      </div>

      <div class="bg-superficie border border-borde rounded-xl p-6 flex flex-col gap-4">
        <p v-if="errorGeneral" class="text-sm text-red-500 text-center">
          {{ errorGeneral }}
        </p>

        <AppInput
          v-model="formulario.email"
          label="Email"
          tipo="email"
          placeholder="tu@email.com"
          :error="errores.email?.[0]"
          requerido
        />

        <AppInput
          v-model="formulario.password"
          label="Contraseña"
          tipo="password"
          placeholder="••••••••"
          :error="errores.password?.[0]"
          requerido
        />

        <AppBoton class="w-full mt-2" :cargando="cargando" @click="enviar"> Entrar </AppBoton>
      </div>

      <p class="text-center text-sm text-texto-muted mt-4">
        ¿No tienes cuenta?
        <router-link
          :to="{ name: 'registro' }"
          class="text-primario font-medium no-underline hover:underline"
        >
          Regístrate
        </router-link>
      </p>
    </div>
  </div>
</template>
