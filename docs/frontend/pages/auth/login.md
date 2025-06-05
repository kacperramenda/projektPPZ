# Login Page

The `Login` page provides users with a form to authenticate and access the application.

## Features

- Displays a login form with fields for email and password.
- Includes validation for required fields and proper email format.
- Provides a "Remember Me" option for persistent login sessions.
- Includes a link to the registration page for new users.

## Dependencies

- **Components**:
  - `Form` - Used for rendering the login form.
  - `Input` - Input fields for email and password.
  - `Button` - Button for submitting the form.
  - `Checkbox` - Checkbox for the "Remember Me" option.

## Example Usage

```vue
<template>
  <div class="login-page">
    <h1>Login</h1>
    <Form @submit="handleLogin">
      <Input v-model="credentials.email" label="Email" type="email" required />
      <Input v-model="credentials.password" label="Password" type="password" required />
      <Checkbox v-model="rememberMe" label="Remember Me" />
      <div class="actions">
        <Button type="submit">Login</Button>
        <a href="/register">Register</a>
      </div>
    </Form>
  </div>
</template>

<script setup>
import Form from '@/components/forms/Form.vue';
import Input from '@/components/forms/Input.vue';
import Button from '@/components/forms/Button.vue';
import Checkbox from '@/components/forms/Checkbox.vue';
import { ref } from 'vue';

const credentials = ref({
  email: '',
  password: '',
});

const rememberMe = ref(false);

const handleLogin = () => {
  // Logic to authenticate the user
};
</script>