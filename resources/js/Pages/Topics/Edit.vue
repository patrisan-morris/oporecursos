<template>
    <div class="p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Edit Topic</h1>
            <a href="/topics" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                ← Back to Topics
            </a>
        </div>

        <div class="bg-white rounded shadow p-6">
            <form @submit.prevent="submit">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Name
                    </label>
                    <input
                        v-model="form.name"
                        id="name"
                        type="text"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        required
                    >
                </div>

                <div>
                    <button
                        type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                    >
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
