<script setup>
defineProps({
  modelValue: {
    type: Boolean,
    default: false,
  },
  label: {
    type: String,
    default: '',
  },
  descripcion: {
    type: String,
    default: '',
  },
  disabled: {
    type: Boolean,
    default: false,
  },
})

defineEmits(['update:modelValue'])
</script>

<template>
  <div class="flex items-center justify-between gap-4">
    <div v-if="label || descripcion" class="flex flex-col">
      <span v-if="label" class="text-sm text-texto font-medium">{{ label }}</span>
      <span v-if="descripcion" class="text-xs text-texto-muted">{{ descripcion }}</span>
    </div>

    <button
      type="button"
      role="switch"
      :aria-checked="modelValue"
      :disabled="disabled"
      class="relative inline-flex h-6 w-11 shrink-0 rounded-full border-2 border-transparent transition-colors duration-200 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none"
      :class="modelValue ? 'bg-primario' : 'bg-borde'"
      @click="$emit('update:modelValue', !modelValue)"
    >
      <span
        class="pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform transition duration-200"
        :class="modelValue ? 'translate-x-5' : 'translate-x-0'"
      />
    </button>
  </div>
</template>
