<script setup>
import { usePage } from '@inertiajs/vue3';
import Profile from '@/components/admin/Profile.vue';

const page = usePage();
const user = page.props.auth.user;
</script>

<template>
    <div class="min-w-full bg-base-200 p-6 border-b-1 border-base-300 flex">
        <div class="ml-auto">
            <Profile :user="user"/>
        </div>
    </div>
</template>
