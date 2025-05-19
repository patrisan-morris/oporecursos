<template>
    <div class="relative w-full">
        <button type="button" class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-left shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary flex justify-between items-center" @click="open = !open" :id="id">
            <span class="block truncate text-gray-700">
                {{ selectedLabel }}
            </span>
            <svg class="w-4 h-4 ml-2 text-gray-400 transform transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <ul v-show="open" class="absolute z-10 mt-1 w-full rounded-md bg-white shadow-lg border border-gray-200 max-h-60 overflow-auto focus:outline-none" >
            <li v-for="(label, value) in options" :key="value" @click="selectOption(value)" class="cursor-pointer px-4 py-2 hover:bg-primary/30 hover:text-white text-gray-700" :class="value === model ? 'bg-primary/60 font-medium': ''" >
                {{ label }}
            </li>
            <li v-for="(label, value) in options" :key="value" @click="selectOption(parseOptionKey(value))" :class="parseOptionKey(value) === model ? 'bg-primary/60 text-white font-medium' : ''" class="cursor-pointer px-4 py-2 hover:bg-primary/30 hover:text-white text-gray-700" >
                {{ label }}
            </li>
        </ul>
    </div>
</template>

<script setup>
    import { ref, computed, onMounted } from 'vue'

    const model = defineModel({
        type: [String, Number, null],
        default: null,
        required: true
    })

    const props = defineProps({
        id: {
            type: String,
            default: ''
        },
        options: {
            type: Object,
            required: true
        },
        placeholder: {
            type: String,
            default: 'Selecciona una opción'
        }
    })

    const open = ref(false)

    const selectedLabel = computed(() =>
        (props.options.hasOwnProperty(model.value) ? props.options[model.value] : props.options[null]) ?? props.placeholder
    )

    function selectOption(value) {
        model.value = value
        open.value = false
    }
    function parseOptionKey(value) {
        let parsedValue = value
        if (value === 'null') parsedValue = null
        if (!isNaN(value)) parsedValue = Number(value)
        return parsedValue

    }

    onMounted(() => {
        document.addEventListener('click', (e) => {
            if (!e.target.closest(`#${props.id}`)) {
                open.value = false
            }
        })
    })
</script>
