<template>
    <form @submit.prevent="submit" novalidate class="flex flex-row justify-between items-end gap-4 w-full mb-2">
        <div v-for="(column,key) in columns" :key="key" class="flex flex-row justify-between items-center gap-4 w-full">
            <div v-if="column.type !== 'array'" class="flex flex-row justify-start items-center gap-3 h-full">
                <InputLabel v-if="column.type !== 'color' && column.type !== 'icon'" :for="key" :value="`${column.label}:`" class="text-lightPrimary font-semibold text-[16px]" />
                <span v-if="column.type === 'color' || column.type === 'icon'" class="text-lightPrimary font-semibold text-[16px]">{{ column.label }}:</span>
                <TextInput v-if="column.type === 'date' || column.type === 'number'" :id="key" :type="column.type" :autocomplete="column.autocomplete" class="block  focus:border-lightPrimary focus:ring-lightPrimary text-md disabled:bg-gray-100" v-model="form[key]" :disabled="form.disabled" />
                <ColorPicker v-if="column.type === 'color'" :id="key" class="block w-full focus:border-lightPrimary focus:ring-lightPrimary text-md disabled:bg-gray-100" v-model="form[key]" :disabled="form.disabled" />
                <IconPicker v-if="column.type === 'icon'" :id="key" class="block w-full focus:border-lightPrimary focus:ring-lightPrimary text-md disabled:bg-gray-100" v-model="form[key]" :disabled="form.disabled" />
            </div>
            <div v-if="column.type === 'array'" class="flex flex-col justify-between items-start gap-2 w-full h-full">
                <InputLabel v-if="column.type !== 'color' && column.type !== 'icon'" :for="key" :value="`${column.label}:`" class="text-lightPrimary font-semibold text-[16px] pb-1" />
                <span v-if="column.type === 'color' || column.type === 'icon'" class="text-lightPrimary font-semibold text-[16px]">{{ column.label }}:</span>
                <div class="flex flex-row items-center gap-2 mb-2">
                    <div v-for="(element, row) in column.elements" class="flex flex-row items-center gap-2">
                        <InputLabel :for="element.id" :value="`${element.label}:`" class="text-light"/>
                        <TextInput :id="element.id" :type="element.type" class="block  focus:border-lightPrimary focus:ring-lightPrimary text-md disabled:bg-gray-100" v-model="form[element.id]"/>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script setup>
    import InputLabel from '@/Components/ItemForm/InputLabel.vue'
    import TextInput from '@/Components/ItemForm/TextInput.vue'
    import SelectInput from '@/Components/ItemForm/SelectInput.vue'
    import ColorPicker from '@/Components/ItemForm/ColorPicker.vue'
    import IconPicker from '../ItemForm/IconPicker.vue'
    import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
    import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue'
    import { computed } from 'vue'

    const props = defineProps({
        form: Object,
        columns: Object,
        data: Array,
        submit: Function,
    })
</script>
