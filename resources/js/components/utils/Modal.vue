<script setup>
import { ref, onMounted, defineExpose } from 'vue'

const props = defineProps({
    id: Number,
    class: String,
})

const dialogRef = ref(null)

const showModal = () => {
    dialogRef.value?.showModal()
}

const closeModal = () => {
    dialogRef.value?.close()
}

defineExpose({ showModal, closeModal }) // <-- make methods available to parent

onMounted(() => {
    if (!dialogRef.value.showModal) {
        console.warn('The <dialog> element is not supported in this browser.')
    }
})
</script>

<template>
    <dialog ref="dialogRef" :id="props.id" :class="['modal', props.class]">
        <div class="modal-box p-12">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <slot></slot>
        </div>
    </dialog>
</template>
