<template>
    <div class="p-8">
        <FlashMessage />
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">My Topics</h1>
            <a href="/topics/create" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + New Topic
            </a>
        </div>

        <div class="bg-white rounded shadow p-6">
            <table class="w-full table-auto">
                <thead>
                    <tr class="text-left">
                        <th class="border-b p-4">#</th>
                        <th class="border-b p-4">Name</th>
                        <th class="border-b p-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="topic in topics" :key="topic.id" class="hover:bg-gray-100">
                        <td class="border-b p-4">{{ topic.id }}</td>
                        <td class="border-b p-4">{{ topic.name }}</td>
                        <td class="border-b p-4 space-x-2">
                            <a :href="`/topics/${topic.id}/edit`" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            <button @click="deleteTopic(topic.id)" class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script setup>
    import { router } from '@inertiajs/vue3';
    import { ref } from 'vue';
    import FlashMessage from '@/Components/FlashMessage.vue';

    const props = defineProps({
        topics: Array
    });

    // Función para eliminar un topic
    const deleteTopic = (id) => {
        if (confirm('Are you sure you want to delete this topic?')) {
            router.delete(`/topics/${id}`);
        }
    };
</script>
