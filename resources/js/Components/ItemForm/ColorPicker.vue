<template>
    <div class="grid grid-cols-4 gap-x-2 gap-y-4 pt-3">
        <button v-for="color in colors" :key="color" type="button" :class="['flex items-center justify-center w-8 h-8 rounded-full ring-2 hover:ring-lightPrimary transition-all duration-300', modelValue === color ? 'ring-primary' : 'ring-gray-300' ]" @click="$emit('update:modelValue', color)">
            <div class="w-6 h-6 rounded-full" :class="`${color}`"></div>
        </button>
    </div>
</template>

<script setup>
    const props = defineProps({
        modelValue: {
            type: [String, null],
            default: null
        }
    })

    const emit = defineEmits(['update:modelValue'])

    const colors = [
        'bg-darkPrimary',
        'bg-primary',
        'bg-lightPrimary',
        'bg-pink-500',
        'bg-yellow-500',
        'bg-orange-500',
        'bg-green-500',
        'bg-blue-500',
    ]
</script>
