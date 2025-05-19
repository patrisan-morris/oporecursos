<template>
    <button @click.prevent="$emit('openModal', {show:true, type:'edit', id:item.id})">
        <EditIcon class="text-lightPrimary size-6 " title="Edit"/>
    </button>
    <button @click.prevent="$emit('openModal', {show:true, type:'delete', id:item.id})">
        <RemoveIcon class="text-darkPrimary size-6 fill-gray-900" title="Delete"/>
    </button>
</template>

<script setup>
    import EditIcon from '@/Components/Icons/Edit.vue'
    import RemoveIcon from '@/Components/Icons/Remove.vue'

    const props = defineProps({
        item:{
            type:Object,
            required:true
        }
    })

    const emit = defineEmits(['openModal'])

</script>
