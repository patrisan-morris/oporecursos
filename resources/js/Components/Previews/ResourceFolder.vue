<template>
    <div class="h-full w-3/5 min-h-[160px] hover:scale-110 transition-all duration-300 group">
        <div class="relative w-full h-full rounded-lg bg-primary">
            <!-- Corner -->
            <div class="absolute -top-1 -right-1 size-14 bg-gray-100 clip-path-triangle group-hover:size-[4.5rem] transition-all duration-300"></div>
            <div class="absolute top-0 right-0 size-12 bg-white/50 clip-path-triangle rounded-se-lg rotate-180 group-hover:size-16 transition-all duration-300">
                <component :is="fileTypeMap[data.datatype]" class="size-6 text-white absolute top-1 right-1 group-hover:top-2 group-hover:right-2 transition-all duration-300" />
            </div>
            <!-- Title -->
            <div class="w-full h-[72%] absolute bottom-0">
                <div class="absolute bottom-0 h-[80%] w-full flex flex-col items-center justify-start rounded-lg group-hover:h-[85%] transition-all duration-300">
                    <div class="font-medium tracking-wide text-white text-md text-center px-10 h-[70%] flex items-center line-clamp-2">
                        {{ data.title }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
    import { capitalize } from '@/Utils/helpers.js'
    import { fileTypeMap } from '@/Utils/map.js'

    const props = defineProps({
        data:{
            type: Object,
            required: true
        },
    })

    props.data.color = 'bg-primary' // Default color if not provided
    props.data.datatype = 'link'

</script>

