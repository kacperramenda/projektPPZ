<script setup>
import { Link } from '@inertiajs/vue3';
import { VueElement } from 'vue';

const props = defineProps({
    name: {
        type: String,
        required: true,
    },
    icon: {
        type: VueElement,
        required: true,
    },
    routeName: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Link :href="route(`${props.routeName}`)" class="flex gap-2 w-full hover:bg-base-300 p-2 rounded-sm transition-all">
        <component :is="props.icon" class="w-5 h-5" />
        {{ props.name }}
    </Link>
</template>