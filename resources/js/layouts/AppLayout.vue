<script setup>
import ToastContainer from '@/components/toasts/ToastContainer.vue';
</script>

<template>
    <div>
        <ToastContainer />
        <slot />
    </div>
</template>