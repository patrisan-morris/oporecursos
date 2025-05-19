<template>
    <Head title="Topics" />
    <AuthenticatedLayout>
        <div class="">
            <FlashMessage />
            <div class="flex justify-between items-start mb-6">
                <div class="flex flex-col pr-8">
                    <div class="flex flex-row items-start gap-2">
                        <TopicIcon class="text-primary size-10 fill-primary" title="Topics"/>
                        <h1 class="font-medium leading-relaxed text-3xl md:text-4xl text-transparent bg-clip-text bg-gradient-to-r from-darkPrimary to-lightPrimary mb-4">Topics</h1>
                    </div>
                </div>
                <div class="flex flex-row justify-between gap-2">
                    <PrimaryButton customClass="px-2 py-3" class="border-2 bg-primary text-white fill-white hover:bg-white border-primary hover:text-primary transitial-all duration-300" @click.prevent="toogleView()">
                        <SearchIcon class="size-6" title="Search"/>
                    </PrimaryButton>
                    <PrimaryButton customClass="px-2 py-3" class="border-2 bg-primary text-white fill-white hover:bg-white border-primary hover:text-primary transitial-all duration-300" @click.prevent="toogleView()">
                        <FilterIcon class="size-6" title="Filter"/>
                    </PrimaryButton>
                    <PrimaryButton customClass="px-2 py-3" class="border-2 bg-primary text-white fill-white hover:bg-white border-primary hover:text-primary transitial-all duration-300" @click.prevent="toogleView()">
                        <GridIcon v-if="viewTable === 'list'" class="size-6" title="Grid"/>
                        <ListIcon v-else class="size-6" title="List"/>
                    </PrimaryButton>
                    <PrimaryButton customClass="px-4 py-3" class="border-2 bg-primary text-white fill-white hover:bg-white border-primary hover:text-primary transitial-all duration-300" @click.prevent="toogleModal({show:true, type:'create', id:null})">
                        + Topic
                    </PrimaryButton>
                </div>
            </div>

            <section v-if="viewTable === 'list'">
                <Table :columns="columns" :data="topics" :sortColumn="sortColumn" :sortDirection="sortDirection" @sortByColumn="sortByColumn" @openModal="toogleModal">
                </Table>
            </section>
            <section v-if="viewTable === 'grid'">
                <Grid :data="topics" type="topic" @openModal="toogleModal"></Grid>
            </section>
            <Modal :show="showModal" @close="toogleModal({show:false})">
                <div class="flex flex-col items-center py-10 px-32">
                    <h2 class="font-medium leading-relaxed text-3xl md:text-4xl text-transparent bg-clip-text bg-primary mb-4">
                        {{ modal.title }}
                    </h2>
                    <div class="mt-6 w-full">
                        <p v-if="modal.action === 'delete'" class="bg-red-100 text-red-800 rounded shadow mb-4 p-4 w-full text-center"> Are you sure to delete this topic?</p>
                        <div class="text-sm text-gray-600 w-full">
                            <Form :form="form" :columns="columns" :topics="topics" :submit="modal.submit" :buttonLabel="modal.button" />
                        </div>
                    </div>
                </div>
            </Modal>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
    import { Head, router, Link, usePage } from '@inertiajs/vue3'
    import { reactive, ref, nextTick } from 'vue'
    import TopicIcon from '@/Components/Icons/Topics.vue'
    import GridIcon from '@/Components/Icons/Grid.vue'
    import ListIcon from '@/Components/Icons/List.vue'
    import SearchIcon from '@/Components/Icons/Search.vue'
    import FilterIcon from '@/Components/Icons/Filter.vue'
    import TopicFolderIcon from '@/Components/TopicFolder.vue'
    import FlashMessage from '@/Components/FlashMessage.vue'
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
    import Modal from '@/Components/Modal.vue'
    import Form from '@/Components/Forms/TopicForm.vue'
    import Table from '@/Components/Table.vue'
    import Grid from '@/Components/Grid.vue'

    const props = defineProps({
        topics: Array,
        columns: Object,
    })

    const page = usePage()
    const showModal = ref(false)
    const form = reactive({})
    const viewTable = ref('list')
    const sortColumn = ref('name');
    const sortDirection = ref('asc');
    const modal = reactive({
        title: 'Create Topic',
        action: 'create',
        button: 'Create',
        id: null,
        submit: () => {
            const url = modal.action === 'create' ? '/topics' : `/topics/${modal.id}`
            const method = modal.action === 'create' ? 'post' : modal.action === 'edit' ? 'put' : 'delete'
            router.visit(url, {
                method,
                data: form,
                preventScroll: true,
                preserveState: true,
                onSuccess: async () => {
                    await nextTick();
                    if (!hasValidationErrors()) {
                        toogleModal({show:false})
                    }
                },
                onError: (errors) => {
                    console.log("Errors in request:", errors)
                },
            })
        },
    })

    resetForm()

    function sortByColumn(column){
        if (sortColumn.value === column) {
            sortDirection.value = sortDirection.value === 'asc' ? 'desc' : 'asc';
        } else {
            sortColumn.value = column;
            sortDirection.value = 'asc';
        }
        props.topics.sort((a, b) => {
            if (a[column] < b[column]) {
                return sortDirection.value === 'asc' ? -1 : 1;
            }
            if (a[column] > b[column]) {
                return sortDirection.value === 'asc' ? 1 : -1;
            }
            return 0;
        });
    }

    function resetForm(topic = null){
        Object.keys(props.columns).forEach(key => {
            form[key] = topic ? topic[key] : ''
        })
        if(topic === null){
            form['disabled'] = false
        }
    }

    function toogleModal({show, type = 'create', id = null}){
        showModal.value = show
        if(show){
            modal.action = type
            modal.id = id
            modal.title = type === 'create'? 'Create Topic': type === 'edit'? 'Update Topic': 'Delete Topic'
            modal.button = type === 'create' ? 'Create': type === 'edit'? 'Update':'Delete'
            form.disabled = type === 'delete' ? true : false
            if (type !== 'create') {
                const topic = props.topics.find(topic => topic.id === id)
                resetForm(topic)
            } else {
                resetForm()
            }
        }
    }

    function toogleView(){
        viewTable.value = viewTable.value === 'list' ? 'grid' : 'list'
    }

    function hasValidationErrors(){
        return page.props.errors && Object.keys(page.props.errors).length > 0
    }

</script>
