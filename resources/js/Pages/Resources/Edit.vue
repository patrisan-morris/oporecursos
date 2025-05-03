<template>
    <div class="p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Edit Resource</h1>
            <a href="/resources" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                ← Back to Resources
            </a>
        </div>

        <Form :form="form" :topics="topics" :submit="submit" buttonLabel="Update" />
    </div>
</template>

<script setup>
    import { reactive } from 'vue';
    import { router } from '@inertiajs/vue3';
    import Form from './Form.vue';

    const props = defineProps({
        resource: Object,
        topics: Array,
        selectedTopics: Array
    });

    const form = reactive({
        title: props.resource.title,
        description: props.resource.description,
        link: props.resource.link,
        topics: [...props.selectedTopics]
    });

    const submit = () => {
        router.put(`/resources/${props.resource.id}`, form);
    };
</script>
