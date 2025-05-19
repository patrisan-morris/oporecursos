<template>
    <form @submit.prevent="submit" novalidate>
        <div class="grid grid-cols-6 mb-4 gap-6">
            <div v-for="([key,column]) in filteredColumns" :key="key" :class="`${column.formClass} flex flex-col justify-start items-start mb-2 gap-2`">
                <InputLabel v-if="column.type !== 'color' && column.type !== 'icon'"  :for="key" :value="`${column.label}:`" class="text-lightPrimary font-semibold text-[16px] pb-1"/>
                <span v-else class="text-lightPrimary font-semibold text-[16px]">{{ column.label }}:</span>
                <TextInput v-if="column.type === 'text' || column.type === 'number'" :id="key" :type="column.type" :autocomplete="column.autocomplete" class="block w-full focus:border-lightPrimary focus:ring-lightPrimary text-md disabled:bg-gray-100" v-model="form[key]" required autofocus :disabled="form.disabled"/>
                <SelectInput v-if="column.type === 'select'" :id="key" v-model="form[key]" :options="presentationTopics" class="w-full"></SelectInput>
                <ColorPicker v-if="column.type === 'color'" :id="key" class="block w-full focus:border-lightPrimary focus:ring-lightPrimary text-md disabled:bg-gray-100" v-model="form[key]" :disabled="form.disabled"/>
                <IconPicker v-if="column.type === 'icon'" :id="key" class="block w-full focus:border-lightPrimary focus:ring-lightPrimary text-md disabled:bg-gray-100" v-model="form[key]" :disabled="form.disabled"/>
                <InputError v-if="$page.props.errors && $page.props.errors[key]" class="mt-1" :message="$page.props.errors[key]" />
            </div>
        </div>
        <div class="flex flex-col justify-center items-start mt-6 mb-10 w-1/2">
            <span class="text-lightPrimary font-semibold text-[16px] pb-4">Previsualize:</span>
            <TopicFolderIcon :topic="form" class="w-1/2"></TopicFolderIcon>
        </div>

        <div class="flex flex-row justify-end items-center mb-4">
            <PrimaryButton class="bg-primary hover:bg-white hover:border-primary hover:text-primary">
                {{ buttonLabel }}
            </PrimaryButton>
        </div>
    </form>
</template>

<script setup>
    import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
    import InputLabel from '@/Components/ItemForm/InputLabel.vue'
    import TextInput from '@/Components/ItemForm/TextInput.vue'
    import InputError from '@/Components/ItemForm/InputError.vue'
    import SelectInput from '@/Components/ItemForm/SelectInput.vue'
    import ColorPicker from '@/Components/ItemForm/ColorPicker.vue'
    import IconPicker from '../ItemForm/IconPicker.vue'
    import TopicFolderIcon from '@/Components/TopicFolder.vue'
    import { computed } from 'vue'
    import { useForm } from '@inertiajs/vue3'

    const props = defineProps({
        form: Object,
        columns: Object,
        topics: Array,
        submit: Function,
        buttonLabel: {
            type: String,
            default: 'Save'
        }
    })

    const filteredColumns = computed(() => {
        return Object.entries(props.columns).filter(([key, column]) => {
            return column.formable
        })
    })

    const presentationTopics = computed(() => {
        const base = { null: 'No parent' }

        let mapped = Object.fromEntries(
            props.topics.map(topic => {
                return [topic.id, topic.name]
            })
        )
        const merged = { ...base, ...mapped }
        const sorted = Object.entries(merged).sort(([keyA], [keyB]) => {
            return keyA - keyB
        })
        mapped = Object.fromEntries(sorted)
        return mapped
    })

</script>
