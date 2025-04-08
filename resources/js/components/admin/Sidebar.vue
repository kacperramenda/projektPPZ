<script setup>
import Menu from '@/components/admin/Menu.vue';
import { useForm } from '@inertiajs/vue3';
import Logout from '@/components/icons/Logout.vue';

const logout = () => {
    const form = useForm({})
    form.post(route('logout'))
}
</script>

<template>
    <div class="min-w-[250px] border-r-base-300 border-r-1 flex flex-col">
        <div class="p-6 flex flex-col gap-6">
            <h1 class="font-bold text-center">UserManager</h1>
            <Menu/>
        </div>
        <div class="w-full border-t-1 border-base-300 mt-auto">
            <div class="p-6">
                <button @click="logout" class="flex gap-2 w-full hover:bg-base-300 p-2 rounded-sm transition-all items-center text-sm cursor-pointer">
                    <Logout class="w-5 h-5" />
                    Logout
                </button>
            </div>
        </div>
    </div>
</template>