<script setup>
import Input from '@/components/forms/Input.vue';
import Textarea from '@/components/forms/Textarea.vue';
import { useForm } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    errors: {
        type: Object,
        default: () => ({})
    }
});

const form = useForm({
    name: '',
    surname: '',
    email: '',
    password: '',
    password_confirmation: '',
    description: ''
});

const submit = () => {
    form.post(route('register'), {
        onSuccess: () => {
            form.reset();
        },
        onError: (errors) => {
            console.log(errors);
        }
    });
};
</script>

<template>
    <Head title="Register"/>
    <div class="flex items-center justify-center w-full min-h-[100vh] bg-base-200 flex-col">
        <h1 class="my-3 font-semibold">Create new account</h1>
        <div class="sm:min-w-[600px] flex shadow-lg">
            <div class="p-12 bg-white w-full">
                <form class="flex flex-col" @submit.prevent="submit">
                    <Input v-model="form.name" placeholder="Your name" label="Name" :required="true" :errors="props.errors.name"/>
                    <Input v-model="form.surname" placeholder="Your surname" label="Surname" :required="true" :errors="props.errors.surname"/>
                    <Input v-model="form.email" placeholder="Email address" label="Email" :required="true" :errors="props.errors.email"/>
                    <Input v-model="form.password" placeholder="Password" label="Password" type="password" :required="true" :errors="props.errors.password"/>
                    <Input v-model="form.password_confirmation" placeholder="Confirm password" label="Confirm password" type="password" :required="true" :errors="props.errors.password_confirmation"/>
                    <Textarea v-model="form.description" placeholder="Your bio" label="Description"/>
                    <button class="btn btn-neutral w-full mt-4">Register</button>
                </form>
            </div>
        </div>
    </div>
</template>
