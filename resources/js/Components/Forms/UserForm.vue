<template>
    <form @submit.prevent="submit" novalidate>
        <div class="flex flex-col justify-center items-start mb-8 gap-2">
            <InputLabel for="name" value="Name:" class="text-lightPrimary font-semibold text-[16px]"/>
            <TextInput id="name" type="text" class="block w-full focus:border-lightPrimary focus:ring-lightPrimary text-md disabled:bg-gray-100" v-model="form.name" required autofocus :disabled="form.disabled"/>
            <InputError v-if="$page.props.errors && $page.props.errors.name" class="mt-1" :message="form.errors.name" />
        </div>
        <div class="flex flex-col justify-center items-start mb-8 gap-2">
            <InputLabel for="email" value="Email:" class="text-lightPrimary font-semibold text-[16px]"/>
            <TextInput id="email" type="email" class="block w-full focus:border-lightPrimary focus:ring-lightPrimary text-md disabled:bg-gray-100" v-model="form.email" required autofocus :disabled="form.disabled"/>
            <InputError v-if="$page.props.errors && $page.props.errors.email" class="mt-1" :message="form.errors.email" />
        </div>
        <div class="flex flex-col justify-center items-start mb-8 gap-2">
            <InputLabel for="password" value="Password:" class="text-lightPrimary font-semibold text-[16px]"/>
            <TextInput id="password" type="password" class="block w-full focus:border-lightPrimary focus:ring-lightPrimary text-md disabled:bg-gray-100" v-model="form.password" required autofocus :disabled="form.disabled"/>
            <InputError v-if="$page.props.errors && $page.props.errors.password" class="mt-1" :message="form.errors.password" />
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

    const props = defineProps({
        form: Object,
        submit: Function,
        buttonLabel: {
            type: String,
            default: 'Save'
        }
    })
</script>
