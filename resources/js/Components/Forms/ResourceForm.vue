<template>
    <form @submit.prevent="submit" novalidate>
        <div class="flex flex-col justify-center items-start mb-8 gap-2">
            <InputLabel for="title" value="Title:" class="text-lightPrimary font-semibold text-[16px]"/>
            <TextInput id="title" type="text" class="block w-full focus:border-lightPrimary focus:ring-lightPrimary text-md disabled:bg-gray-100" v-model="form.title" required autofocus :disabled="form.disabled"/>
            <InputError v-if="$page.props.errors && $page.props.errors.title" class="mt-1" :message="form.errors.title" />
        </div>
        <div class="flex flex-col justify-center items-start mb-8 gap-2">
            <InputLabel for="description" value="Description:" class="text-lightPrimary font-semibold text-[16px]"/>
            <textarea id="description" class="rounded-md border-gray-300 block w-full focus:border-lightPrimary focus:ring-lightPrimary text-md disabled:bg-gray-100" v-model="form.description" required autofocus :disabled="form.disabled"></textarea>
            <InputError v-if="$page.props.errors && $page.props.errors.description" class="mt-1" :message="form.errors.description" />
        </div>

        <div class="flex flex-col justify-center items-start mb-8 gap-2">
            <InputLabel for="link" value="Link:" class="text-lightPrimary font-semibold text-[16px]"/>
            <TextInput id="link" type="url" class="block w-full focus:border-lightPrimary focus:ring-lightPrimary text-md disabled:bg-gray-100" v-model="form.link" required autofocus :disabled="form.disabled"/>
            <InputError v-if="$page.props.errors && $page.props.errors.link" class="mt-1" :message="form.errors.link" />
        </div>
        <div v-if="topics" class="flex flex-col justify-center items-start mb-8 gap-2">
            <InputLabel for="topics" value="Topics:" class="text-lightPrimary font-semibold text-[16px]"/>
            <div v-for="topic in topics" :key="topic.id" class="flex items-center mb-2">
                <Checkbox :value="topic.id" v-model="form.topics" class="mr-2"></Checkbox>
                <span> {{ topic.name }}</span>
            </div>
        </div>

        <div class="flex flex-row justify-end items-center mb-4">
            <PrimaryButton class="bg-primary hover:bg-white hover:border-primary hover:text-primary">
                {{ buttonLabel }}
            </PrimaryButton>
        </div>
    </form>
</template>

<script setup>
    import PrimaryButton from '../Buttons/PrimaryButton.vue'
    import InputLabel from '../ItemForm/InputLabel.vue'
    import TextInput from '../ItemForm/TextInput.vue'
    import InputError from '../ItemForm/InputError.vue'
    import Checkbox from '../ItemForm/Checkbox.vue'

    const props = defineProps({
        form: Object,
        topics: Array,
        submit: Function,
        buttonLabel: {
            type: String,
            default: 'Save'
        }
    })
</script>
