# Users Page

The `Users` page provides administrators with the ability to view, search, and manage a list of users within the application.

## Features

- Displays a table of users with details such as name, email, and role.
- Includes search and filter functionality to find specific users.
- Provides actions to edit or delete users.

## Dependencies

- **Components**:
  - `Header` - Displays the page header with navigation or branding.
  - `Sidebar` - Provides navigation links for the admin panel.
  - `Table` - Used for rendering the list of users in a tabular format.
  - `Button` - Buttons for performing actions like editing or deleting users.
  - `Modal` - Used for confirming user deletion.

## Example Usage

```vue
<template>
  <div class="users-page">
    <Header />
    <div class="page-layout">
      <Sidebar />
      <main>
        <h1>Users</h1>
        <div class="actions">
          <input v-model="searchQuery" placeholder="Search users..." />
        </div>
        <Table :rows="filteredUsers" @edit="handleEdit" @delete="handleDelete" />
        <Modal v-if="isDeleteModalOpen" @close="closeDeleteModal">
          <p>Are you sure you want to delete this user?</p>
          <Button @click="confirmDelete">Yes</Button>
          <Button @click="closeDeleteModal">No</Button>
        </Modal>
      </main>
    </div>
  </div>
</template>

<script setup>
import Header from '@/components/admin/Header.vue';
import Sidebar from '@/components/admin/Sidebar.vue';
import Table from '@/components/table/Table.vue';
import Modal from '@/components/utils/Modal.vue';
import Button from '@/components/forms/Button.vue';
import { ref, computed } from 'vue';

const users = ref([
  { id: 1, name: 'John Doe', email: 'john@example.com', role: 'Admin' },
  { id: 2, name: 'Jane Smith', email: 'jane@example.com', role: 'User' },
]);

const searchQuery = ref('');
const isDeleteModalOpen = ref(false);
const userToDelete = ref(null);

const filteredUsers = computed(() =>
  users.value.filter(user =>
    user.name.toLowerCase().includes(searchQuery.value.toLowerCase())
  )
);

const handleEdit = user => {
  // Logic to navigate to the edit page for the selected user
};

const handleDelete = user => {
  userToDelete.value = user;
  isDeleteModalOpen.value = true;
};

const confirmDelete = () => {
  users.value = users.value.filter(user => user.id !== userToDelete.value.id);
  closeDeleteModal();
};

const closeDeleteModal = () => {
  isDeleteModalOpen.value = false;
  userToDelete.value = null;
};
</script>