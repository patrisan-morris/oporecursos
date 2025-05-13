<template>
    <Head title="Resources" />
    <AuthenticatedLayout>
        <div class="">
            <FlashMessage />
            <div class="flex justify-between items-start mb-6">
                <div class="flex flex-col w-full pr-8">
                    <div class="flex flex-row items-start">
                        <ResourceIcon class="text-primary size-10 fill-primary" title="Resources"/>
                        <h1 class="font-medium leading-relaxed text-3xl md:text-4xl text-transparent bg-clip-text bg-gradient-to-r from-darkPrimary to-lightPrimary mb-4">Resources</h1>
                    </div>
                    <p class="text-gray-600 font-normal text-lg tracking-wide">Manage your resources related to idea and knowledge management.</p>
                </div>
                <div class="w-1/6">
                    <PrimaryButton class="w-full bg-primary hover:bg-white hover:border-primary hover:text-primary" @click.prevent="toogleModal(true, 'create', null)">
                        + New Resource
                    </PrimaryButton>
                </div>
            </div>

            <div class="bg-white rounded border-2 border-lightPrimary shadow-md">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="text-left border-b border-lightPrimary bg-lightPrimary/30 text-gray-900">
                            <th class="p-4">Title</th>
                            <th class="p-4">Link</th>
                            <th class="p-4 text-right"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="resource in resources" :key="resource.id" class="odd:bg-lightPrimary/5 even:bg-lightPrimary/10 hover:bg-lightPrimary/20">
                            <td class="px-4 py-3">{{ resource.title }}</td>
                            <td class="px-4 py-3">
                                <a v-if="resource.link" :href="resource.link" target="_blank" class="text-blue-500 underline">
                                    Visit
                                </a>
                            </td>
                            <td class="flex flex-row items-center justify-end px-6 py-3 space-x-2 text-right">
                                <button @click.prevent="toogleModal(true, 'edit', resource.id)">
                                    <EditIcon class="text-gray-900 size-6 fill-gray-900" title="Edit"/>
                                </button>
                                <button @click.prevent="toogleModal(true, 'delete', resource.id)">
                                    <RemoveIcon class="text-gray-900 size-6 fill-gray-900" title="Delete"/>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <Modal :show="showModal" @close="toogleModal(false)">
                <div class="flex flex-col items-center py-10 px-32">
                    <h2 class="font-medium leading-relaxed text-3xl md:text-4xl text-transparent bg-clip-text bg-primary mb-4">
                        {{ modal.title }}
                    </h2>
                    <div class="mt-6 w-full">
                        <p v-if="modal.action === 'delete'" class="bg-red-100 text-red-800 rounded shadow mb-4 p-4 w-full text-center"> Are you sure to delete this resource?</p>
                        <div class="text-sm text-gray-600 w-full">
                            <Form :form="form" :submit="modal.submit" :buttonLabel="modal.button" />
                        </div>
                    </div>
                </div>
            </Modal>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
    import { Head, router, usePage } from '@inertiajs/vue3'
    import { reactive, ref, nextTick } from 'vue'
    import FlashMessage from '@/Components/FlashMessage.vue'
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import PrimaryButton from '@/Components/PrimaryButton.vue'
    import ResourceIcon from '@/Components/Icons/Resources.vue'
    import EditIcon from '@/Components/Icons/Edit.vue'
    import RemoveIcon from '@/Components/Icons/Remove.vue'
    import Modal from '@/Components/Modal.vue'
    import Form from '@/Components/Forms/ResourceForm.vue'

    const props = defineProps({
        resources: Array
    })

    const page = usePage()

    const showModal = ref(false)

    const modal = reactive({
        title: 'Create Resource',
        action: 'create',
        button: 'Create',
        id: null,
        submit: () => {
            const url = modal.action === 'create' ? '/resources' : `/resources/${modal.id}`
            const method = modal.action === 'create' ? 'post' : modal.action === 'edit' ? 'put' : 'delete'

            router.visit(url, {
                method,
                data: form,
                preventScroll: true,
                preserveState: true,
                onSuccess: async () => {
                    await nextTick()
                    if (!hasValidationErrors()) {
                        toogleModal(false)
                    }
                },
                onError: (errors) => {
                    console.log("Errors in request:", errors)
                },
            })
        },
    })

    const form = reactive({
        title: '',
        description: '',
        topics : [],
        link: '',
        disabled: false,
    })

    const resetForm = () => {
        form.title = ''
        form.description = ''
        form.topics = []
        form.link = ''
        form.disabled = false
    }

    const toogleModal = (show, type = 'create', id = null) => {
        showModal.value = show
        modal.action = type
        modal.id = id
        modal.title = type === 'create'? 'Create Resource': type === 'edit'? 'Update Resource':'Delete Resource'
        modal.button = type === 'create' ? 'Create': type === 'edit'? 'Update':'Delete'
        form.disabled = type === 'delete' ? true : false
        if (type !== 'create') {
            const resource = props.resources.find(resource => resource.id === id)
            form.title = resource.title
            form.description = resource.description
            form.topics = resource.topics
            form.link = resource.link
        } else {
            resetForm()
        }
    }

    const hasValidationErrors = () => {
        return page.props.errors && Object.keys(page.props.errors).length > 0
    }

</script>
