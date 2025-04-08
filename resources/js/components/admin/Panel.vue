<script setup>
    const props = defineProps({
        name: {
            type: String,
            required: true,
        },
    });
</script>

<template>
<div class="shadow-sm border-base-300 p-4 flex flex-col gap-4">
    <span class="font-bold">
        {{ props.name }}
    </span>
    <slot></slot>
</div>
</template>
