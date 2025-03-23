<script setup>
const props = defineProps(
    {
        label: String,
        name: String,
        placeholder: String,
        class: String,
        required: Boolean,
        errors: Array,
    }
);
</script>

<template>
    <fieldset class="fieldset">
        <legend class="fieldset-legend" :class="props.errors ? '!text-error' : ''">{{ props.label }}<span class="text-error" v-if="props.required">*</span></legend>
        <textarea class="textarea h-24 w-full" :class="props.class, props.errors ? '!textarea-error !text-error' : ''" :placeholder="props.placeholder" :name="props.name"></textarea>
        <div v-if="props.errors" class="flex flex-col">
            <span v-for="error in errors" class="label-text-alt text-error">{{ error.message }}</span>
        </div>
    </fieldset>
</template>
