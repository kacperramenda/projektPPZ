<script setup>
import { useToastStore } from '@/stores/useToastStore'
import Toast from '@/components/toasts/Toast.vue'
import { watch } from 'vue'
import { usePage } from '@inertiajs/vue3'

const toastStore = useToastStore()
const page = usePage()

watch(
    () => page.props,
    (props) => {
        const message = props.flash?.message
        const type = props.flash?.type || 'info'

        if (message) {
            toastStore.addToast({
                id: Date.now(),
                message,
                type,
            })
        }
    },
    { immediate: true, deep: true }
)
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
