<template>
    <table class="w-full table-auto">
        <thead class="">
            <tr class="text-left">
                <th v-for="(column, key) in columns" :key="key" :class="`py-2 px-4 text-${column.align} gap-2`" @click="column.sortable ? sortByColumn(key) : null">
                    <div v-if="column.listable" class="text-white text-md font-normal tracking-wide">
                        <span :class="'inline ' + sortColumn === key ? 'text-primary' : 'text-primary'">
                            {{column.label}}
                        </span>
                        <span v-if="column.sortable" class="cursor-pointer relative mx-1">
                            <SortFillIcon class="absolute text-primary size-6 inline" title="Sort"/>
                            <SortIcon v-if="sortColumn === key && sortDirection === 'asc'" class="absolute text-primary size-6 inline" title="Sort Ascending"/>
                            <SortIcon v-else-if="sortColumn === key && sortDirection === 'desc'" class="absolute text-primary size-6 rotate-180 inline" title="Sort Descending"/>
                        </span>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody class="bg-gray-100 rounded-lg divide-y-8 divide-gray-100 text-sm uppercase font-medium text-gray-600">
            <tr v-for="item in data" :key="item.id" class="odd:bg-white even:bg-lightPrimary/10 hover:bg-lightPrimary/20 shadow-sm">
                <td v-for="(column, key) in columns" :key="key" :class="`px-4 py-2 first:rounded-s-lg last:rounded-e-lg text-${column.align}`">
                    <div v-if="column.listable">
                        <div v-if="key === 'created_at' || key === 'updated_at'">
                            {{ formatDate(item[key]) }}
                        </div>
                        <div v-else-if="key === 'actions'" class="">
                            <ActionsData :item="item" @openModal="emit('openModal',$event)"></ActionsData>
                        </div>
                        <div v-else-if="column.type === 'icon'" class="flex items-center justify-center">
                            <component v-if="iconMap[item[key]]" :is="iconMap[item[key]]" class="size-6" title="Icon"/>
                            <span v-else>-</span>
                        </div>
                        <div v-else-if="column.type === 'color'" class="flex items-center justify-center">
                            <div class="flex items-center justify-center rounded-full w-8 h-8">
                                <div class="w-6 h-6 rounded-full" :class="`text-${column.align} ${item[key]}`"></div>
                            </div>
                        </div>
                        <div v-else-if="column.tableable">
                            {{ getTableableValue(item, column.tableable) }}
                        </div>
                        <div v-else>
                            {{ item[key] === null ? '-' : item[key] }}
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</template>
<script setup>
    import SortFillIcon from '@/Components/Icons/SortFill.vue'
    import SortIcon from '@/Components/Icons/Sort.vue'
    import { iconMap } from '@/Utils/map.js'
    import ActionsData from '@/Components/ActionsData.vue'
    import { ref } from 'vue'

    const props = defineProps({
        columns: {
            type: Object,
            required: true
        },
        data: {
            type: Array,
            required: true
        },
        sortColumn: {
            type: String,
            default: null
        },
        sortDirection: {
            type: String,
            default: 'asc'
        }
    })

    const emit = defineEmits(['openModal'])

    const getTableableValue = (item, tableable) => {
        const [relationKey, propertyKey] = Object.entries(tableable)[0]
        return item?.[relationKey]?.[propertyKey] ?? '-'
    }

    function formatDate(dateStr){
        const date = new Date(dateStr)
        const day = String(date.getDate()).padStart(2, '0')
        const month = String(date.getMonth() + 1).padStart(2, '0')
        const year = String(date.getFullYear())

        return `${day}/${month}/${year}`
    }


</script>
