# Profile Component

The `Profile` component displays user profile information, such as the user's name and avatar.

## Props

- **`user`**: *(Object, required)* - The user object containing profile details. Expected properties:
  - **`name`**: *(String)* - The name of the user.
  - **`avatar`**: *(String)* - The URL of the user's avatar image.

## Dependencies

This component does not have any external dependencies.

## Example Usage

```vue
<template>
  <Profile :user="authUser" />
</template>

<script setup>
import Profile from '@/components/Profile.vue';

const authUser = {
  name: 'John Doe',
  avatar: '/images/avatar.jpg',
};
</script>