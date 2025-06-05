# Toast Component

The `Toast` component is used to display temporary notifications or messages to the user. It supports different types of messages, such as informational, success, error, and neutral.

## Props

- **`toast`**: *(Object, required)* - The toast object containing the following properties:
  - **`id`**: *(Number, required)* - A unique identifier for the toast.
  - **`message`**: *(String, optional)* - The message to display in the toast. Defaults to `'New message arrived.'`.
  - **`type`**: *(String, optional)* - The type of the toast. Can be one of `'error'`, `'neutral'`, `'info'`, or `'success'`. Defaults to `'info'`.
  - **`duration`**: *(Number, optional)* - The duration (in milliseconds) for which the toast is displayed. Defaults to `5000`.

## Dependencies

This component depends on the `useToastStore` composable for managing toast state.

## Example Usage

```vue
<template>
  <Toast :toast="toast" />
</template>

<script setup>
import Toast from '@/components/Toast.vue';

const toast = {
  id: 1,
  message: 'Operation successful!',
  type: 'success',
  duration: 3000,
};
</script>