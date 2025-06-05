# Textarea Component

The `Textarea` component is a reusable form textarea field with validation and error handling.

## Props

| Name         | Type    | Required | Default | Description                                                                 |
|--------------|---------|----------|---------|-----------------------------------------------------------------------------|
| `label`      | String  | No       | `null`  | The label text for the textarea field.                                      |
| `name`       | String  | No       | `null`  | The name attribute for the textarea field.                                  |
| `placeholder`| String  | No       | `null`  | Placeholder text for the textarea field.                                    |
| `class`      | String  | No       | `null`  | Additional CSS classes to apply to the textarea field.                      |
| `required`   | Boolean | No       | `false` | Indicates whether the textarea field is required.                           |
| `errors`     | Array   | No       | `null`  | Array of error messages to display if validation fails.                     |

## Slots

This component does not use slots.

## Example Usage

```vue
<template>
  <Textarea
    label="Description"
    name="description"
    placeholder="Enter your description"
    :required="true"
    :errors="descriptionErrors"
  />
</template>

<script setup>
import Textarea from '@/components/Textarea.vue';

const descriptionErrors = [{ message: "Description is required." }];
</script>