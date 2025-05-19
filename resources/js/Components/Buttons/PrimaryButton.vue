<template>
    <button :class="computedClass">
        <slot />
    </button>
</template>

<script setup>
    import { computed } from 'vue'

    const props = defineProps({
        customClass: {
            type: String,
            default: 'py-3 px-6'
        }
    })

    const computedClass = computed(() => {
        return `bg-primary text-white font-semibold rounded-lg shadow-md hover:bg-white border-primary border-2 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50 ${props.customClass}`
    })

</script>
