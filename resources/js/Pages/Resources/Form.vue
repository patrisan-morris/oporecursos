<template>
    <form @submit.prevent="submit" novalidate>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Title</label>
            <input
                v-model="form.title"
                id="title"
                type="text"
                class="input"
            >
            <div v-if="$page.props.errors && $page.props.errors.title" class="text-red-600 text-sm mt-1">
                {{ $page.props.errors.title }}
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Description</label>
            <textarea
                v-model="form.description"
                id="description"
                class="input"
            ></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="link">Link</label>
            <input
                v-model="form.link"
                id="link"
                type="url"
                class="input"
            >
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Topics</label>
            <div v-for="topic in topics" :key="topic.id" class="flex items-center mb-2">
                <input
                    type="checkbox"
                    :value="topic.id"
                    v-model="form.topics"
                    class="mr-2"
                >
                <span>{{ topic.name }}</span>
            </div>
        </div>

        <div>
            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            >
                {{ buttonLabel }}
            </button>
        </div>
    </form>
</template>

<script setup>
    const props = defineProps({
        form: Object,
        topics: Array,
        submit: Function,
        buttonLabel: {
            type: String,
            default: 'Save'
        }
    });
</script>
