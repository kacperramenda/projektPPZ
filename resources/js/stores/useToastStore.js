import { defineStore } from 'pinia';

export const useToastStore = defineStore('toast', {
    state: () => ({
        toasts: [],
        nextId: 1
    }),
    actions: {
        addToast(toast) {
            const id = this.nextId++;
            this.toasts.push({
                id,
                message: toast.message,
                type: toast.type || 'info',
                duration: toast.duration || 5000
            });

            // Auto-remove toast
            setTimeout(() => {
                this.removeToast(id);
            }, toast.duration || 5000);
        },
        removeToast(id) {
            this.toasts = this.toasts.filter(toast => toast.id !== id);
        }
    }
});