<script setup>
import { router } from '@inertiajs/vue3'
import AdminDashboardLayout from '@/layouts/AdminDashboardLayout.vue';
import Table from '@/components/table/Table.vue';
import Panel from '@/components/admin/Panel.vue';

const props = defineProps({
    users: {
        type: Array,
        default: () => []
    },
});

function confirmDelete(userId) {
  if (confirm('Czy na pewno chcesz usunąć tego użytkownika?')) {
    router.delete(route('admin.users.delete', userId));
  }
}

function deleteUser(id) {
    if (confirm('Czy na pewno chcesz usunąć tego użytkownika?')) {
        router.delete(route('admin.users.delete', id));
    }
}
</script>

<template>
    <div v-if="$page.props.flash.success" class="alert alert-success mb-4">
    {{ $page.props.flash.success }}
  </div>
  
    <AdminDashboardLayout>
        <Panel name="Users">
            <Table>
                <thead>
                    <tr>
                        <th class="text-left">ID</th>
                        <th class="text-left">Name</th>
                        <th class="text-left">Surname</th>
                        <th class="text-left">Email</th>
                        <th class="text-left">Role</th>
                        <th class="text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in props.users" :key="user.id">
                        <td>{{ user.id }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.surname }}</td>
                        <td>{{ user.email }}</td>
                        <td>
                            <span v-for="role in user.roles" :key="role.id">{{ role.name }}</span>
                        </td>
                        <td class="flex gap-2">
                            <Link :href="route('admin.users.edit', user.id)" class="btn btn-primary">Edit</Link>
                            <Link
                                :href="route('admin.users.delete', user.id)"
                                method="delete"
                                as="button"
                                class="btn btn-error"
                                @click.prevent="confirmDelete(user.id)">
                                Delete
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </Table>
        </Panel>
    </AdminDashboardLayout>
</template>
