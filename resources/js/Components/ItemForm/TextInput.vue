<template>
    <input :id="id" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" v-model="model" ref="input"/>
</template>
<script setup>
    import { onMounted, ref } from 'vue';

    const model = defineModel({
        type: [String, Number, null],
        default: '',
        required: true
    });
    const props = defineProps({
        id: {
            type: String,
            default: ''
        }
    });

    const input = ref(null);

    onMounted(() => {
        if (input.value.hasAttribute('autofocus')) {
            input.value.focus();
        }
    });

    defineExpose({ focus: () => input.value.focus() });
</script>
