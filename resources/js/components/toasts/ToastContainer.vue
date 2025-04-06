<script setup>
import { useToastStore } from '@/stores/useToastStore';
import Toast from '@/components/toasts/Toast.vue';
import { onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';
const toastStore = useToastStore();

onMounted(() => {
    if (usePage().props.flash.message) {
        const type = usePage().props.flash.type || 'info'
        const message = usePage().props.flash.message

        toastStore.addToast({
            id: Date.now(),
            message,
            type
        })
    }
});
</script>

<template>
    <div class="absolute right-0 bottom-5 flex flex-col gap-2">
        <Toast
            v-for="toast in toastStore.toasts"
            :key="toast.id"
            :toast="toast"
        />
    </div>
</template>