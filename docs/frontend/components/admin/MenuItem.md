# MenuItem Component

The `MenuItem` component represents a single item in a navigation menu.

## Props

- **`label`**: *(String, required)* - The text to display for the menu item.
- **`icon`**: *(String, optional)* - The name or path of the icon to display alongside the label.
- **`link`**: *(String, required)* - The URL or route the menu item navigates to.
- **`active`**: *(Boolean, optional)* - Indicates whether the menu item is currently active.

## Dependencies

This component does not have any external dependencies.

## Example Usage

```vue
<template>
  <MenuItem
    label="Dashboard"
    icon="dashboard-icon"
    link="/dashboard"
    :active="true"
  />
</template>

<script setup>
import MenuItem from '@/components/MenuItem.vue';
</script>