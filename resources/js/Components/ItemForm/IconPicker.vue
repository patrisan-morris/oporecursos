<template>
    <div class="grid grid-cols-4 gap-x-2 gap-y-4 pt-3">
        <button v-for="icon in icons" :key="icon.name" type="button" @click="$emit('update:modelValue', icon.name)" :class="['flex items-center justify-center w-8 h-8 rounded-full ring-2 hover:ring-lightPrimary transition-all duration-300', modelValue === icon.name ? 'ring-primary' : 'ring-gray-300']">
            <component :is="icon.component" class="w-6 h-6" />
        </button>
    </div>
</template>

<script setup>
    import LawIcon from '@/Components/Icons/Law.vue'
    import NetworkIcon from '@/Components/Icons/Network.vue'
    import SystemIcon from '@/Components/Icons/System.vue'
    import DatabaseIcon from '@/Components/Icons/Database.vue'
    import ProgramIcon from '@/Components/Icons/Program.vue'
    import WireIcon from '@/Components/Icons/Wire.vue'
    import MailIcon from '@/Components/Icons/Mail.vue'
    import WebIcon from '@/Components/Icons/Web.vue'


    const props = defineProps({
        modelValue: {
            type: [String, null],
            default: null
        }
    })

    const emit = defineEmits(['update:modelValue'])

    const icons = [
        {name: 'Law', component: LawIcon},
        {name: 'Network', component: NetworkIcon},
        {name: 'System', component: SystemIcon},
        {name: 'Database', component: DatabaseIcon},
        {name: 'Program', component: ProgramIcon},
        {name: 'Wire', component: WireIcon},
        {name: 'Mail', component: MailIcon},
        {name: 'Web', component: WebIcon},
    ]
</script>
