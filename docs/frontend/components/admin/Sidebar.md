# Sidebar Component

The `Sidebar` component is a vertical navigation menu with a logout button.

## Props

This component does not accept any props directly.

## Dependencies

- **`Menu`**: A child component used to render the menu items.
- **`useForm`**: A composable from Inertia.js used to handle the logout functionality.
- **`Logout`**: An icon component used for the logout button.

## Example Usage

```vue
<template>
  <Sidebar />
</template>

<script setup>
import Sidebar from '@/components/Sidebar.vue';
</script>