<template>
    <button :class="computedClass">
        <slot />
    </button>
</template>

<script setup>
    import { computed } from 'vue'

    const props = defineProps({
        size: {
            type: String,
            default: 'large'
        },
        customClass: {
            type: Array,
            default: ['bg-primary text-white fill-white']
        }
    })

    const computedClass = computed(() => {
        return `font-semibold rounded-lg shadow-md hover:bg-white hover:text-primary hover:fill-primary border-primary border-2 tracking-wide focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50 transition-all duration-300 ${props.customClass} ${props.size}`
    })

</script>


