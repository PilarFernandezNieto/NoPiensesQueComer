<script setup>
defineProps({
  padding: {
    type: String,
    default: 'md',
    validator: (v) => ['sm', 'md', 'lg', 'none'].includes(v),
  },
})

const clasesPadding = {
  none: '',
  sm: 'p-3',
  md: 'p-4',
  lg: 'p-6',
}
</script>

<template>
  <div class="bg-superficie border border-borde rounded-xl" :class="clasesPadding[padding]">
    <slot />
  </div>
</template>
