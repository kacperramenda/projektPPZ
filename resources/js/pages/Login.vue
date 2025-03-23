<script setup>
import { Link } from '@inertiajs/vue3';
import Input from '@/components/forms/Input.vue';

const props = defineProps({
    errors: {
        type: Object,
        default: () => ({})
    }
});
</script>

<template>
    <div class="flex items-center justify-center w-full min-h-[100vh] bg-base-200 flex-col">
        <h1 class="my-3 font-semibold">Login to your account</h1>
        <div class="sm:min-w-[500px] min-w-[0px] flex shadow-lg">
            <div class="p-12 bg-white w-full">
                <form class="flex flex-col">
                    <Input name="email" placeholder="Email address" label="Email" :required="true" :errors="props.errors.email"/>
                    <Input name="password" placeholder="Password" label="Password" type="password" :required="true" :errors="props.errors.password"/>
                    <button class="btn btn-neutral w-full mt-4">Login</button>
                    <div class="flex">
                        <Link :href="route('register')" class="ml-auto text-sm mt-2">Dont have account?</Link>
                    </div>
                    <div v-if="props.errors.login" class="flex flex-col">
                        <span v-for="error in errors" class="label-text-alt text-error">{{ error.message }}</span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
