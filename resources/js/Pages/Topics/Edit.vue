<template>
    <div class="p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Edit Topic</h1>
            <a href="/topics" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                ← Back to Topics
            </a>
        </div>

        <Form :form="form" :submit="submit" buttonLabel="Update" />
    </div>
</template>

<script setup>
    import { reactive } from 'vue';
    import { router } from '@inertiajs/vue3';
    import Form from './Form.vue';

    const props = defineProps({
        topic: Object
    });

    const form = reactive({
        name: props.topic.name,
    });

    // Función para enviar el formulario de edición
    const submit = () => {
        router.put(`/topics/${props.topic.id}`, form);
    };
</script>
