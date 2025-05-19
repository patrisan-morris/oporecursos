<template>
    <!-- Breadcrumb -->
    <div class="w-full mt-2">
        <nav class="flex flex-row items-center space-x-2 text-sm text-gray-500 mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 group">
                <li>
                    <div class="flex items-center">
                        <button @click="goTo(null)" :class="['flex items-center gap-1 text-primary hover:underline font-medium', breadcrumb.length === 0 ? 'hover:no-underline' : 'hover:underline']">
                            <HomeIcon class="size-6"/>
                            <span>Home</span>
                        </button>
                    </div>
                </li>
                <li v-for="(crumb, index) in breadcrumb" :key="crumb.id">
                    <div class="flex items-center">
                        <ArrowIcon/>
                        <button @click="goTo(crumb.id)" :class="['flex items-center text-primary hover:underline  font-medium gap-1 cursor-pointer', index !== breadcrumb.length - 1 ? 'hover:underline' : 'hover:no-underline' ]">
                            <component v-if="iconMap[crumb.icon]" :is="iconMap[crumb.icon]" class="size-6" title="Icon"/>
                            {{ crumb.name }}
                        </button>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Grid de hijos -->
    <section v-if="children.length > 0" class="grid grid-flow-row grid-cols-6 gap-10">
        <article  v-for="item in children" :key="item.id" class="flex flex-col items-center justify-center gap-2 col-span-1" @click="currentTopicId = item.id" >
            <TopicFolderIcon v-if="type === 'topic'" :topic="item" @goTo="goTo" @openModal="emit('openModal',$event)"/>
        </article>
    </section>
    <section v-else class="flex flex-col justify-center items-center w-full">
        <NoData class="size-64 fill-primary"/>
        <h2 class="text-primary font-semibold text-xl tracking-wide">No data yet</h2>
        <p class="text-gray-500 text-sm mt-2 text-center max-w-md">This {{ type }} doesn't contain any lessons, resources or topics yet. Start adding content to bring it to life.</p>
    </section>
</template>

<script setup>
    import { ref, computed } from 'vue'
    import TopicFolderIcon from '@/Components/TopicFolder.vue'
    import HomeIcon from '@/Components/Icons/Home.vue'
    import ArrowIcon from '@/Components/Icons/Arrow.vue'
    import { iconMap } from '@/Utils/iconMap.js'
    import NoData from '@/Components/Backgrounds/Nodata.vue'
    import ActionsData from '@/Components/ActionsData.vue'

    const props = defineProps({
        data: {
            type: Array,
            required: true
        },
        type: {
            type: String,
            default: 'topic'
        },
    })

    const emit = defineEmits(['openModal'])

    const currentId = ref(null)

    const children = computed(() =>
        props.data.filter(t => t.parent_id === currentId.value)
    )

    const breadcrumb = computed(() => {
        const path = []
        let topic = props.data.find(t => t.id === currentId.value)

        while (topic) {
            path.unshift(topic)
            topic = props.data.find(t => t.id === topic.parent_id)
        }

        return path
    })

    function goTo(id){
        console.log('CurrrentId:' + currentId.value)
        console.log('Id:')
        console.log(id)
        currentId.value = id
    }

</script>
