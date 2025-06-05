# Register Page

The `Register` page provides users with a form to create a new account in the application.

## Features

- Displays a registration form with fields for user details such as name, email, and password.
- Includes validation for required fields, proper email format, and password strength.
- Provides a link to the login page for existing users.

## Dependencies

- **Components**:
  - `Form` - Used for rendering the registration form.
  - `Input` - Input fields for user details.
  - `Button` - Button for submitting the form.

## Example Usage

```vue
<template>
  <div class="register-page">
    <h1>Register</h1>
    <Form @submit="handleRegister">
      <Input v-model="user.name" label="Name" required />
      <Input v-model="user.email" label="Email" type="email" required />
      <Input v-model="user.password" label="Password" type="password" required />
      <div class="actions">
        <Button type="submit">Register</Button>
        <a href="/login">Already have an account? Login</a>
      </div>
    </Form>
  </div>
</template>

<script setup>
import Form from '@/components/forms/Form.vue';
import Input from '@/components/forms/Input.vue';
import Button from '@/components/forms/Button.vue';
import { ref } from 'vue';

const user = ref({
  name: '',
  email: '',
  password: '',
});

const handleRegister = () => {
  // Logic to register the user
};
</script>