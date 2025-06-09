<script setup>
import { useForm } from '@inertiajs/vue3'
import AdminDashboardLayout from '@/layouts/AdminDashboardLayout.vue'
import Panel from '@/components/admin/Panel.vue'
import Input from '@/components/forms/Input.vue';
import Select from '@/components/forms/Select.vue';

const props = defineProps({
    user: Object,
    roles: Array,
})

const form = useForm({
    name: props.user.name,
    surname: props.user.surname,
    email: props.user.email,
    roles: [props.user.roles[0].name],
})

function submit() {
    form.put(route('admin.users.update', props.user.id))
}

const roleOptions = props.roles.map(role => ({
    value: role.name,
    label: role.name,
}))

const panelName = `Edit User: ${form.name} ${form.surname}`

</script>

<template>
    <AdminDashboardLayout>
        <Panel :name="panelName">
            <div v-if="Object.keys(form.errors).length" class="text-red-600">
                <ul class="list-disc pl-4">
                    <li v-for="(msg, key) in form.errors" :key="key">{{ msg }}</li>
                </ul>
            </div>
            <form @submit.prevent="submit" class="space-y-4 max-w-[400px]">
                <Input
                    v-model="form.name"
                    label="Name"
                    name="name"
                    type="text"
                    :required="true"
                    :errors="form.errors.name"
                />
                <Input
                    v-model="form.surname"
                    label="Surname"
                    name="surname"
                    type="text"
                    :required="true"
                    :errors="form.errors.surname"
                />
                <Input
                    v-model="form.email"
                    label="Email"
                    name="email"
                    type="email"
                    :required="true"
                    :errors="form.errors.email"
                />
                <Select
                    class="!w-[400px]"
                    label="Role"
                    :options="roleOptions"
                    v-model="form.roles[0]"
                    name="roles"
                    required
                    :error="form.errors.roles"
                />
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </Panel>
    </AdminDashboardLayout>
</template>
