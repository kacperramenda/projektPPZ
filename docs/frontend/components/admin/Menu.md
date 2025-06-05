# Menu Component

The `Menu` component displays a horizontal menu with customizable menu items.

## Props

This component does not accept any props directly. It uses a local `menuItems` array to define the menu structure.

## Dependencies

- **`MenuItem`**: A child component used to render individual menu items.
- **`UserIcon`**: An icon component used for the "Users" menu item.

## Example Usage

```vue
<template>
  <Menu />
</template>

<script setup>
import Menu from '@/components/admin/Menu.vue';
</script>