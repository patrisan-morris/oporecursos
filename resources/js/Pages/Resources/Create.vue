<template>
    <div class="p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Create Resource</h1>
            <a href="/resources" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                ← Back to Resources
            </a>
        </div>
        <Form :form="form" :topics="topics" :submit="submit" buttonLabel="Create" />
    </div>
</template>

<script setup>
    import { reactive } from 'vue';
    import { router } from '@inertiajs/vue3';
    import Form from './Form.vue';

    const props = defineProps({
        topics: Array
    });

    const form = reactive({
        title: '',
        description: '',
        link: '',
        topics: []
    });

    const submit = () => {
        router.post('/resources', form);
    };
</script>
