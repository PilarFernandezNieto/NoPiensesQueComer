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
  tipo: {
    type: String,
    default: 'text',
  },
  placeholder: {
    type: String,
    default: '',
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

    <input
      :type="tipo"
      :value="modelValue"
      :placeholder="placeholder"
      :disabled="disabled"
      class="w-full text-sm text-texto bg-superficie border rounded-lg px-3 py-2 outline-none transition-colors placeholder:text-texto-muted disabled:opacity-50 disabled:cursor-not-allowed"
      :class="error ? 'border-red-400 focus:border-red-500' : 'border-borde focus:border-primario'"
      @input="$emit('update:modelValue', $event.target.value)"
    />

    <span v-if="error" class="text-xs text-red-500">{{ error }}</span>
  </div>
</template>
