<script setup>
import { useForm } from '@inertiajs/vue3'
import AdminDashboardLayout from '@/layouts/AdminDashboardLayout.vue'
import Panel from '@/components/admin/Panel.vue'

const props = defineProps({
  user: Object,
  roles: Array,
})

const form = useForm({
  name: props.user.name,
  surname: props.user.surname,
  email: props.user.email,
  roles: props.user.roles.map(role => role.name), // Assuming Spatie returns name
})

function submit() {
  form.put(route('admin.users.update', props.user.id))
}
</script>

<template>
  <AdminDashboardLayout>
    <h1 class="text-2xl font-bold mb-4">Edycja użytkownika {{ props.user.name }}</h1>
    <Panel name="Edit User">
        <div v-if="Object.keys(form.errors).length" class="text-red-600">
        <ul class="list-disc pl-4">
            <li v-for="(msg, key) in form.errors" :key="key">{{ msg }}</li>
        </ul>
        </div>
      <form @submit.prevent="submit" class="space-y-4">
        <div>
          <label>Name</label>
          <input v-model="form.name" type="text" class="input" />
        </div>
        <div>
          <label>Surname</label>
          <input v-model="form.surname" type="text" class="input" />
        </div>
        <div>
          <label>Email</label>
          <input v-model="form.email" type="email" class="input" />
        </div>
        <div>
          <label>Roles</label>
          <div class="flex gap-2 flex-wrap">
            <label v-for="role in props.roles" :key="role.id">
              <input
                type="checkbox"
                :value="role.name"
                v-model="form.roles"
              />
              {{ role.name }}
            </label>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
      </form>
    </Panel>
  </AdminDashboardLayout>
</template>

<style scoped>
.input {
  border: 1px solid #ccc;
  padding: 0.5rem;
  width: 100%;
}
</style>
