<template>
    <div class="p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Edit Resource</h1>
            <a href="/resources" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                ← Back to Resources
            </a>
        </div>

        <div class="bg-white rounded shadow p-6">
            <form @submit.prevent="submit">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Title</label>
                    <input v-model="form.title" id="title" type="text" class="input" required />
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Description</label>
                    <textarea v-model="form.description" id="description" class="input"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="link">Link</label>
                    <input v-model="form.link" id="link" type="url" class="input" />
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Topics</label>
                    <div v-for="topic in topics" :key="topic.id" class="flex items-center mb-2">
                        <input
                            type="checkbox"
                            :value="topic.id"
                            v-model="form.topics"
                            class="mr-2"
                        />
                        <span>{{ topic.name }}</span>
                    </div>
                </div>

                <div>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
    import { reactive } from 'vue';
    import { router } from '@inertiajs/vue3';

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
