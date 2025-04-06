<script setup>
import { onMounted, ref, computed, onBeforeUnmount } from 'vue';
import { useToastStore } from '@/stores/useToastStore';

const toastStore = useToastStore();

const props = defineProps({
    toast: {
        type: Object,
        required: true,
        default: () => ({
            id: Number,
            message: {
                type: String,
                default: 'New message arrived.'
            },
            type: {
                type: String,
                default: 'info',
                validator: (value) => ['error', 'neutral', 'info', 'success'].includes(value)
            },
            duration: {
                type: Number,
                default: 5000
            }
        })
    }
});

const progress = ref(0);
const interval = ref(null);
const isHovered = ref(false);

const toastProperties = computed(() => {
    const typeMap = {
        error: {
            border: 'border-error',
            background: 'bg-error',
            text: 'text-error',
            title: 'Error!'
        },
        neutral: {
            border: 'border-neutral',
            background: 'bg-neutral',
            text: 'text-neutral',
            title: 'Notice'
        },
        info: {
            border: 'border-info',
            background: 'bg-info',
            text: 'text-info',
            title: 'Info'
        },
        success: {
            border: 'border-success',
            background: 'bg-success',
            text: 'text-success',
            title: 'Success!'
        }
    };

    return typeMap[props.toast.type] || typeMap.info;
});

const startProgress = () => {
    const intervalTime = 50;
    const increment = (100 * intervalTime) / props.toast.duration;

    interval.value = setInterval(() => {
        if (!isHovered.value) {
            progress.value = Math.min(progress.value + increment, 100);
            if (progress.value >= 100) {
                closeToast();
            }
        }
    }, intervalTime);
};

const pauseProgress = () => {
    isHovered.value = true;
    clearInterval(interval.value);
};

const resumeProgress = () => {
    isHovered.value = false;
    startProgress();
};

const closeToast = () => {
    clearInterval(interval.value);
    toastStore.removeToast(props.toast.id);
};

onMounted(() => {
    console.log(props.toast)
    startProgress();
});

onBeforeUnmount(() => {
    clearInterval(interval.value);
});
</script>

<template>
    <div
        @mouseover="pauseProgress"
        @mouseleave="resumeProgress"
        :class="[
            'relative',
            'transition-all',
            'duration-300',
            'right-6',
            'bg-white',
            'px-8',
            'max-w-[350px]',
            'min-w-[250px]',
            'border-l-8',
            'flex',
            'gap-2',
            'flex-col',
            'py-4',
            'rounded-sm',
            'shadow-lg',
            'mb-2',
            toastProperties.border
        ]"
    >
        <div class="flex items-center justify-between">
            <span :class="['font-bold', 'text-lg', toastProperties.text]">
                {{ toastProperties.title }}
            </span>
            <button
                @click="closeToast"
                :class="['hover:opacity-75', 'transition-opacity', 'cursor-pointer']"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                >
                    <path fill="currentColor"
                          d="m12 13.4l-4.9 4.9q-.275.275-.7.275t-.7-.275t-.275-.7t.275-.7l4.9-4.9l-4.9-4.9q-.275-.275-.275-.7t.275-.7t.7-.275t.7.275l4.9 4.9l4.9-4.9q.275-.275.7-.275t.7.275t.275.7t-.275.7L13.4 12l4.9 4.9q.275.275.275.7t-.275.7t-.7.275t-.7-.275z" />
                </svg>
            </button>
        </div>
        <span class="text-gray-600 text-sm">
            {{ props.toast.message }}
        </span>
        <div class="h-[2px] w-full bg-gray-200 absolute bottom-0 left-0">
            <div
                :class="['h-full', 'transition-[width]', 'duration-50', toastProperties.background]"
                :style="{ width: `${progress}%` }"
            />
        </div>
    </div>
</template>