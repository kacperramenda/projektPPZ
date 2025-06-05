# Modal Component

The `Modal` component is used to display content in a dialog box overlay. It is typically used for user interactions such as forms, confirmations, or additional information.

## Props

- **`id`**: *(Number, optional)* - The unique identifier for the modal.
- **`class`**: *(String, optional)* - Additional CSS classes to apply to the modal for custom styling.

## Methods

- **`showModal`**: Opens the modal programmatically.
- **`closeModal`**: Closes the modal programmatically.

## Slots

- **`default`**: *(required)* - The main content of the modal.

## Example Usage

```vue
<template>
  <Modal id="exampleModal" class="custom-modal">
    <p>This is the content of the modal.</p>
  </Modal>
</template>

<script setup>
import Modal from '@/components/Modal.vue';

let modalRef;

const openModal = () => {
  modalRef.showModal();
};

const closeModal = () => {
  modalRef.closeModal();
};
</script>