<template>
    <form @submit.prevent="submit" novalidate>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Name*</label>
            <input
                v-model="form.name"
                id="name"
                type="text"
                class="input"
            >
            <div v-if="$page.props.errors && page.props.errors.name" class="text-red-600 text-sm mt-1">
                {{ $page.props.errors.name }}
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
        submit: Function,
        buttonLabel: {
            type: String,
            default: 'Save'
        }
    });
</script>
