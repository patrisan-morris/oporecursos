<template>
    <div class="p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Create Topic</h1>
            <a href="/topics" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                ← Back to Topics
            </a>
        </div>
        <Form :form="form" :submit="submit" buttonLabel="Create" />
    </div>
</template>

<script setup>
    import { reactive } from 'vue';
    import { router } from '@inertiajs/vue3';
    import Form from './Form.vue';

    const form = reactive({
        name: '',
    });

    // Función para enviar el formulario
    const submit = () => {
        router.post('/topics', form);
    };
</script>
