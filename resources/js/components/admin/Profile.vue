<script setup>
const props = defineProps({
    user: {
        type: Object,
        required: true
    }
});

const initials = props.user.name[0] + props.user.surname[0];
</script>

<template>
    <div class="flex gap-2">
        <div class="flex items-center justify-center w-10 h-10 aspect-square text-lg text-white font-semibold bg-secondary rounded-full">
            <span>{{ initials }}</span>
        </div>
        <div class="flex flex-col">
            <span class="font-bold">{{ props.user.name }} {{ props.user.surname }}</span>
            <span class="text-sm"> {{ props.user.email }}</span>
        </div>
    </div>
</template>
