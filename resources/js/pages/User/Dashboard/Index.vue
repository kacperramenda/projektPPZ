<script setup>
import { usePage } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'

const user = usePage().props.auth.user

const logout = () => {
    const form = useForm({})
    form.post(route('logout'))
}
</script>

<template>
    <div>
        {{ user.name }} {{ user.surname }}
        <button class="btn btn-neutral w-full mt-4" @click.prevent="logout">Logout</button>
    </div>
</template>