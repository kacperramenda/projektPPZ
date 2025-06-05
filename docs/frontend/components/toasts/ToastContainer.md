# ToastContainer Component

The `ToastContainer` component is used to manage and display a list of toast notifications. It acts as a container for multiple `Toast` components and handles their rendering and positioning.

## Props

This component does not accept any props directly.

## Dependencies

This component depends on the `useToastStore` composable for managing the list of toasts.

## Example Usage

```vue
<template>
  <ToastContainer />
</template>

<script setup>
import ToastContainer from '@/components/ToastContainer.vue';
</script>