<script setup>
import { usePage } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'
import Modal from '@/components/utils/Modal.vue';
import Input from '@/components/forms/Input.vue';
import Textarea from '@/components/forms/Textarea.vue';
import { onMounted, ref } from 'vue';
import { Head } from '@inertiajs/vue3'
import { useToastStore } from '@/stores/useToastStore.js'
import AppLayout from '@/layouts/AppLayout.vue';

const user = usePage().props.auth.user
const editModal = ref(null)
const changePasswordModal = ref(null)
const toastStore = useToastStore()
const deleteModal = ref(null)

const showEditModal = () => {
    editModal.value.showModal()
}

const showChangePasswordModal = () => {
    changePasswordModal.value.showModal()
}

const showDeleteModal = () => {
    deleteModal.value.showModal()
}

const logout = () => {
    const form = useForm({})
    form.post(route('logout'))
}

const props = defineProps({
    errors: {
        type: Object,
        default: () => ({})
    }
})

const form = useForm({
    name: user.name,
    surname: user.surname,
    email: user.email,
    description: user.description
})

const changePasswordForm = useForm({
    current_password: '',
    new_password: '',
    new_password_confirmation: ''
})




const editAccount = () => {
    form.put(route('user.edit', user.id), {
        onSuccess: () => {
            editModal.value.closeModal()
        },
        onError: (errors) => {
            console.log(errors)
        }
    })
}

const changePassword = () => {
    changePasswordForm.put(route('user.changePassword', user.id), {
        onSuccess: () => {
            changePasswordModal.value.closeModal()
        },
        onError: (errors) => {
            console.log(errors)
        }
    })
}

const deleteAccount = () => {
    const deleteForm = useForm({});
    deleteForm.delete(route('user.delete', user.id), {
        onSuccess: () => {
            deleteModal.value.closeModal()
        },
        onError: (errors) => {
            console.log(errors);
        }
    });
};

</script>

<template>
    <AppLayout>

        <Head title="Account" />
        <div class="w-[100vw] h-[100vh] flex flex-col items-center justify-center bg-base-200">
            <div class="p-12 shadow-xl min-h-[400px] min-w-[800px] mx-auto flex flex-col bg-white">
                <div class="flex flex-col gap-2">
                    <h1 class="text-2xl font-bold">{{ user.name }} {{ user.surname }}</h1>
                    <span class="font-bold">Email:</span>
                    <p>{{ user.email }}</p>
                    <span class="font-bold">Description:</span>
                    <p>{{ user.description }}</p>
                    <span class="font-bold">Role:</span>
                    <p>User</p>
                </div>

                <div class="w-full flex gap-2 items-center justify-end mt-auto">
                    <button class="btn btn-primary mt-4" @click.prevent="showEditModal()">Edit account</button>
                    <button class="btn btn-secondary mt-4" @click.prevent="showChangePasswordModal()">Change
                        password</button>
                    <button class="btn btn-error mt-4" @click.prevent="showDeleteModal">Delete account</button>
                    <button class="btn btn-neutral mt-4" @click.prevent="logout">Logout</button>
                </div>
            </div>
        </div>
        <Modal ref="editModal">
            <h1 class="text-xl font-bold mb-4">Edit account info</h1>
            <form class="flex flex-col" @submit.prevent="editAccount">
                <Input v-model="form.name" placeholder="Your name" label="Name" :required="true"
                    :errors="props.errors.name" />
                <Input v-model="form.surname" placeholder="Your surname" label="Surname" :required="true"
                    :errors="props.errors.surname" />
                <Input v-model="form.email" placeholder="Email address" label="Email" :required="true"
                    :errors="props.errors.email" />
                <Textarea v-model="form.description" placeholder="Your bio" label="Description" />
                <button class="btn btn-neutral w-full mt-4">Apply</button>
            </form>
        </Modal>
        <Modal ref="changePasswordModal">
            <h1 class="text-xl font-bold mb-4">Change password</h1>
            <form class="flex flex-col" @submit.prevent="changePassword">
                <Input v-model="changePasswordForm.current_password" placeholder="Current password"
                    label="Current password" type="password" :required="true" :errors="props.errors.current_password" />
                <Input v-model="changePasswordForm.new_password" placeholder="New password" label="New password"
                    type="password" :required="true" :errors="props.errors.password" />
                <Input v-model="changePasswordForm.new_password_confirmation" placeholder="Confirm new password"
                    label="Confirm new password" type="password" :required="true"
                    :errors="props.errors.confirmPassword" />
                <button class="btn btn-neutral w-full mt-4">Change password</button>
            </form>
        </Modal>
        <Modal ref="deleteModal">
            <h1 class="text-xl font-bold mb-4">Delete Account</h1>
            <div class="flex flex-col gap-4">
                <p class="text-gray-600">Are you sure you want to delete your account? This action cannot be undone.</p>
                <div class="flex gap-2 justify-end">
                    <button class="btn" @click="deleteModal.value.closeModal()">Cancel</button>
                    <button class="btn btn-error" @click.prevent="deleteAccount">Delete Account</button>
                </div>
            </div>
        </Modal>
    </AppLayout>
</template>