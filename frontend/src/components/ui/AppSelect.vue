<script setup>
defineProps({
  modelValue: {
    type: [String, Number],
    default: '',
  },
  label: {
    type: String,
    default: '',
  },
  opciones: {
    type: Array,
    default: () => [],
  },
  placeholder: {
    type: String,
    default: 'Selecciona una opción',
  },
  error: {
    type: String,
    default: '',
  },
  disabled: {
    type: Boolean,
    default: false,
  },
  requerido: {
    type: Boolean,
    default: false,
  },
})

defineEmits(['update:modelValue'])
</script>

<template>
  <div class="flex flex-col gap-1">
    <label v-if="label" class="text-xs font-medium text-texto-secundario">
      {{ label }}
      <span v-if="requerido" class="text-red-500 ml-0.5">*</span>
    </label>

    <select
      :value="modelValue"
      :disabled="disabled"
      class="w-full text-sm text-texto bg-superficie border rounded-lg px-3 py-2 outline-none transition-colors disabled:opacity-50 disabled:cursor-not-allowed appearance-none cursor-pointer"
      :class="error ? 'border-red-400 focus:border-red-500' : 'border-borde focus:border-primario'"
      @change="$emit('update:modelValue', $event.target.value)"
    >
      <option value="" disabled>{{ placeholder }}</option>
      <option v-for="opcion in opciones" :key="opcion.valor" :value="opcion.valor">
        {{ opcion.etiqueta }}
      </option>
    </select>

    <span v-if="error" class="text-xs text-red-500">{{ error }}</span>
  </div>
</template>
