<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import Input from '@/components/forms/Input.vue';
import { useForm } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3'
import { onMounted } from 'vue';
import { useToastStore } from '@/stores/useToastStore.js';
import AppLayout from '@/layouts/AppLayout.vue';

const toastStore = useToastStore();

const props = defineProps({
    errors: {
        type: Object,
        default: () => ({})
    }
});

const form = useForm({
    email: '',
    password: '',
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Login"/>
    <AppLayout>
    <div class="flex items-center justify-center w-full min-h-[100vh] bg-base-200 flex-col">
        <h1 class="my-3 font-semibold">Login to your account</h1>
        <div class="sm:min-w-[500px] min-w-[0px] flex shadow-lg">
            <div class="p-12 bg-white w-full">
                <form class="flex flex-col" @submit.prevent="submit">
                    <Input v-model="form.email" placeholder="Email address" label="Email" :required="true" :errors="props.errors.email"/>
                    <Input v-model="form.password" placeholder="Password" label="Password" type="password" :required="true" :errors="props.errors.password"/>
                    <button class="btn btn-neutral w-full mt-4">Login</button>
                    <div class="flex">
                        <Link :href="route('register')" class="ml-auto text-sm mt-2">Dont have account?</Link>
                    </div>
                    <div v-if="props.errors.login" class="flex flex-col">
                        <span class="label-text-alt text-error">{{ error.message }}</span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </AppLayout>
</template>
