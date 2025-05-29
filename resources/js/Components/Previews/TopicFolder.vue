<template>
    <div class="transition-all duration-300 hover:scale-110 cursor-pointer relative w-full h-40 group">
        <div class="group-hover:absolute top-0 right-0">
            <ActionsData :item="data" @openModal="emit('openModal', $event)"></ActionsData>
        </div>
        <div :class="`${customColor} w-1/3 h-full rounded-lg absolute bottom-0 left-0`" @click="emit('goTo', {id:data.id})">
            <component v-if="iconMap[data.icon]" :is="iconMap[data.icon]" class="text-white size-6 fill-white relative mx-auto my-[0.4rem]" title="Icon"/>
        </div>
        <div :class="`${customColor} w-full h-[82%] rounded-lg absolute bottom-0 shadow-md`" @click="emit('goTo', data.id)">
            <div class="absolute bottom-0 h-[95%] w-full bg-white/50 flex flex-col items-center justify-start rounded-lg group-hover:h-[85%] transition-all duration-300">
                <div class="font-medium tracking-wide uppercase text-white text-md text-center px-4 h-[70%] flex items-center">
                    {{ data.name }}
                </div>
            </div>
            <div class="flex flex-row justify-between w-full px-4 py-2 text-sm text-white tracking-wide absolute bottom-0">
                <span v-if="data.lessons">{{ data.lessons.length }} lessons</span>
                <span> - </span>
                <span v-if="data.resources">{{ data.resources.length }} resources</span>
            </div>
        </div>
    </div>
</template>
<script setup>
    import TopicIcon from '@/Components/Icons/Topics.vue'
    import { computed } from 'vue'
    import { iconMap } from '@/Utils/map.js'
    import ActionsData from '@/Components/ActionsData.vue'

    const props = defineProps({
        data: {
            type: Object,
            required: true
        },
    })

    const emit = defineEmits(['openModal','goTo'])

    const customColor = computed(() => {
        return props.data.color === null ?  'bg-darkPrimary' : props.data.color
    })
</script>
