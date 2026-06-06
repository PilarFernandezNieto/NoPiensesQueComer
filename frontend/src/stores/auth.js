import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import api from '@/services/api'

export const useAuthStore = defineStore('auth', () => {
  const usuario = ref(JSON.parse(localStorage.getItem('usuario')) || null)
  const token = ref(localStorage.getItem('token') || null)

  const estaAutenticado = computed(() => !!token.value)

  async function login(credenciales) {
    const { data } = await api.post('/login', credenciales)
    usuario.value = data.user
    token.value = data.token
    localStorage.setItem('token', data.token)
    localStorage.setItem('usuario', JSON.stringify(data.user))
  }

  async function registro(datos) {
    const { data } = await api.post('/registro', datos)
    usuario.value = data.user
    token.value = data.token
    localStorage.setItem('token', data.token)
    localStorage.setItem('usuario', JSON.stringify(data.user))
  }

  async function logout() {
    await api.post('/logout')
    usuario.value = null
    token.value = null
    localStorage.removeItem('token')
    localStorage.removeItem('usuario')
  }

  return {
    usuario,
    token,
    estaAutenticado,
    login,
    registro,
    logout,
  }
})
