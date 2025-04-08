<script setup>
import ToastContainer from '@/components/toasts/ToastContainer.vue';
import Sidebar from '@/components/admin/Sidebar.vue';
import Header from '@/components/admin/Header.vue';
</script>

<template>
    <ToastContainer />
    <div class="flex w-[100vw] h-[100vh] bg-base-200">
        <Sidebar />
        <div class="flex flex-col w-full">
            <Header />
            <div class="w-full h-full bg-white p-6">
                <slot></slot>
            </div>
        </div>
    </div>
</template>