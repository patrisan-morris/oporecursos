<template>
    <div class="p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">My Resources</h1>
            <a href="/resources/create" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + New Resource
            </a>
        </div>

        <div class="bg-white rounded shadow p-6">
            <table class="w-full table-auto">
                <thead>
                    <tr class="text-left">
                        <th class="border-b p-4">#</th>
                        <th class="border-b p-4">Title</th>
                        <th class="border-b p-4">Link</th>
                        <th class="border-b p-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="resource in resources" :key="resource.id" class="hover:bg-gray-100">
                        <td class="border-b p-4">{{ resource.id }}</td>
                        <td class="border-b p-4">{{ resource.title }}</td>
                        <td class="border-b p-4">
                            <a v-if="resource.link" :href="resource.link" target="_blank" class="text-blue-500 underline">
                                Visit
                            </a>
                        </td>
                        <td class="border-b p-4 space-x-2">
                            <a :href="`/resources/${resource.id}/edit`" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            <button @click="deleteResource(resource.id)" class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script setup>
    import { router } from '@inertiajs/vue3';

    const props = defineProps({
        resources: Array
    });

    const deleteResource = (id) => {
        if (confirm('Are you sure you want to delete this resource?')) {
            router.delete(`/resources/${id}`);
        }
    };
</script>
