# Header Component

The `Header` component displays a header section with a user profile.

## Props

This component does not accept any props directly. It relies on the `usePage` composable from Inertia.js to access the authenticated user.

## Dependencies

- **`usePage`**: Used to retrieve the authenticated user from the Inertia.js page props.
- **`Profile`**: A child component that displays the user profile.

## Example Usage

```vue
<template>
  <Header />
</template>

<script setup>
import Header from '@/components/Header.vue';
</script>