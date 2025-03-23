<script setup>
import Input from '@/components/forms/Input.vue';
import Textarea from '@/components/forms/Textarea.vue';
const props = defineProps({
    errors: {
        type: Object,
        default: () => ({})
    }
});
</script>

<template>
    <div class="flex items-center justify-center w-full min-h-[100vh] bg-base-200 flex-col">
        <h1 class="my-3 font-semibold">Create new account</h1>
        <div class="sm:min-w-[600px] flex shadow-lg">
            <div class="p-12 bg-white w-full">
                <form class="flex flex-col">
                    <Input name="name" placeholder="Your name" label="Name" :required="true" :errors="props.errors.name"/>
                    <Input name="surname" placeholder="Your surname" label="Surname" :required="true" :errors="props.errors.surname"/>
                    <Input name="email" placeholder="Email address" label="Email" :required="true" :errors="props.errors.email"/>
                    <Input name="password" placeholder="Password" label="Password" type="password" :required="true" :errors="props.errors.password"/>
                    <Input name="confirm_password" placeholder="Confirm password" label="Confirm password" type="password" :required="true" :errors="props.errors.confirmPassword"/>
                    <Textarea name="bio" placeholder="Your bio" label="Description"/>
                    <button class="btn btn-neutral w-full mt-4">Register</button>
                </form>
            </div>
        </div>
    </div>
</template>
