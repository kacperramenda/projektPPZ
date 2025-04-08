<script setup>
import AdminDashboardLayout from '@/layouts/AdminDashboardLayout.vue';
import Table from '@/components/table/Table.vue';
import Panel from '@/components/admin/Panel.vue';
const props = defineProps({
    users: {
        type: Array,
        default: () => []
    },
});
</script>

<template>
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
                            <span v-bind:key="role.id" v-for="role in user.roles">{{role.name}}</span>
                        </td>
                        <td class="flex gap-2">
                            <Link :href="route('admin.users.edit', user.id)" class="btn btn-primary">Edit</Link>
                            <Link :href="route('admin.users.delete', user.id)" class="btn btn-error">Delete</Link>
                        </td>
                    </tr>
                </tbody>
            </Table>
        </Panel>
    </AdminDashboardLayout>
</template>

<style scoped>

</style>