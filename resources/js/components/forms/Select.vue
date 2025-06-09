<script setup lang="ts">
import { defineProps, defineEmits } from 'vue'

const props = defineProps<{
  label: string
  options: Array<{ value: string | number, label: string }>
  modelValue: string | number | null
  name?: string
  required?: boolean
  error?: string
  optionalLabel?: string
    class?: string
}>()

const emit = defineEmits(['update:modelValue'])

function onChange(event: Event) {
  const target = event.target as HTMLSelectElement
  emit('update:modelValue', target.value)
}
</script>

<template>
  <fieldset class="fieldset">
    <legend class="fieldset-legend">{{ label }}</legend>
    <select
      class="select !w-full"
      :name="name"
      :required="required"
      :value="modelValue"
      @change="onChange"
    >
      <option disabled value="">
        {{ optionalLabel || 'Wybierz opcję' }}
      </option>
      <option
        v-for="option in options"
        :key="option.value"
        :value="option.value"
      >
        {{ option.label }}
      </option>
    </select>
    <span v-if="error" class="text-red-600">{{ error }}</span>
    <span v-else-if="!required" class="label">Opcjonalne</span>
  </fieldset>
</template>
