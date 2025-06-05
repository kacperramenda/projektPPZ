# User Page

The `User` page allows authenticated users to view and manage their account details, including editing personal information, changing their password, and deleting their account.

## Features

- Displays user details such as name, surname, email, and description.
- Provides a modal for editing account information.
- Includes functionality to change the user's password.
- Allows users to delete their account with confirmation.

## Dependencies

- **Components**:
  - `AppLayout` - The main layout for the page.
  - `Modal` - Used for displaying modals for editing, changing passwords, and account deletion.
  - `Input` - Input fields for user details and password forms.
  - `Textarea` - Textarea for editing the user's description.
  - `Button` - Buttons for submitting forms and performing actions.

## Example Usage

```vue
<template>
  <AppLayout>
    <div class="user-page">
      <h1>{{ user.name }} {{ user.surname }}</h1>
      <p>Email: {{ user.email }}</p>
      <p>Description: {{ user.description }}</p>
      <button @click="showEditModal">Edit Account</button>
      <button @click="showChangePasswordModal">Change Password</button>
      <button @click="showDeleteAccountModal">Delete Account</button>
    </div>
    <Modal ref="editModal">
      <form @submit.prevent="editAccount">
        <Input v-model="form.name" label="Name" required />
        <Input v-model="form.surname" label="Surname" required />
        <Input v-model="form.email" label="Email" required />
        <Textarea v-model="form.description" label="Description" />
        <button type="submit">Save</button>
      </form>
    </Modal>
    <Modal ref="changePasswordModal">
      <form @submit.prevent="changePassword">
        <Input v-model="changePasswordForm.current_password" label="Current Password" type="password" required />
        <Input v-model="changePasswordForm.password" label="New Password" type="password" required />
        <Input v-model="changePasswordForm.password_confirmation" label="Confirm Password" type="password" required />
        <button type="submit">Change Password</button>
      </form>
    </Modal>
    <Modal ref="deleteAccountModal">
      <p>Are you sure you want to delete your account?</p>
      <button @click="deleteAccount">Delete</button>
      <button @click="closeDeleteAccountModal">Cancel</button>
    </Modal>
  </AppLayout>
</template>

<script setup>
import { ref, reactive } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import Modal from '@/components/utils/Modal.vue';
import Input from '@/components/forms/Input.vue';
import Textarea from '@/components/forms/Textarea.vue';

const user = reactive({
  name: 'John',
  surname: 'Doe',
  email: 'john.doe@example.com',
  description: 'A brief bio about John.',
});

const form = reactive({ ...user });
const changePasswordForm = reactive({
  current_password: '',
  password: '',
  password_confirmation: '',
});

const showEditModal = () => {};
const showChangePasswordModal = () => {};
const showDeleteAccountModal = () => {};
const editAccount = () => {};
const changePassword = () => {};
const deleteAccount = () => {};
const closeDeleteAccountModal = () => {};
</script>