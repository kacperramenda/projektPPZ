<script setup>
const props = defineProps({
    label: String,
    name: String,
    type: String,
    placeholder: String,
    class: String,
    required: Boolean,
    errors: String,
});
const model = defineModel();
</script>

<template>
    <fieldset class="fieldset">
        <legend class="fieldset-legend" :class="props.errors ? '!text-error' : ''">
            {{ props.label }}
            <span class="text-error" v-if="props.required">*</span>
        </legend>
        <input
            v-model="model"
            :type="props.type"
            class="input w-full"
            :class="[props.class, props.errors ? 'input-error !text-error' : '']"
            :name="props.name"
            :placeholder="props.placeholder"
        />
        <div v-if="props.errors" class="flex flex-col">
            <span class="label-text-alt text-error">{{ props.errors }}</span>
        </div>
    </fieldset>
</template>
