# Input Component

The `Input` component is a reusable form input field with validation and error handling.

## Props

| Name         | Type    | Required | Default | Description                                                                 |
|--------------|---------|----------|---------|-----------------------------------------------------------------------------|
| `label`      | String  | No       | `null`  | The label text for the input field.                                         |
| `name`       | String  | No       | `null`  | The name attribute for the input field.                                     |
| `type`       | String  | No       | `text`  | The type of the input field (e.g., `text`, `password`, `email`).            |
| `placeholder`| String  | No       | `null`  | Placeholder text for the input field.                                       |
| `class`      | String  | No       | `null`  | Additional CSS classes to apply to the input field.                         |
| `required`   | Boolean | No       | `false` | Indicates whether the input field is required.                              |
| `errors`     | String  | No       | `null`  | Error message to display if validation fails.                               |

## Slots

This component does not use slots.

## Example Usage

```vue
<template>
  <Input
    label="Email"
    name="email"
    type="email"
    placeholder="Enter your email"
    :required="true"
    :errors="emailError"
  />
</template>

<script setup>
import Input from '@/components/Input.vue';

const emailError = "Invalid email address.";
</script>