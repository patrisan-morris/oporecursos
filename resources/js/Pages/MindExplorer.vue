<template>
    <Head :title="nameData" />
    <AuthenticatedLayout>
        <div class="">
            <FlashMessage />
            <div class="flex justify-between items-center mb-3">
                <div class="flex flex-col mb-6">
                    <div class="flex flex-row items-start gap-2">
                        <component :is="menuMap[nameData]" class="text-primary size-10 fill-primary" :title="nameData"/>
                        <h1 class="font-medium leading-relaxed text-3xl md:text-4xl text-transparent bg-clip-text bg-gradient-to-r from-darkPrimary to-lightPrimary mb-2">{{ nameData }}</h1>
                    </div>
                    <p class="text-gray-400 font-medium text-md tracking-widest">{{ description }}</p>
                </div>
                <div class="flex flex-row justify-between gap-2">
                    <TextInput id="search" type="text" v-model="searchQuery" placeholder="Enter the search..." class="rounded-md"></TextInput>
                    <PrimaryButton size="small" @click.prevent="toogleFilter()">
                        <component :is="optionsMap['Filter']" class="size-6" title="Filter"/>
                    </PrimaryButton>
                    <!-- <PrimaryButton size="small" @click.prevent="toogleView()">
                        <component :is="optionsMap['Grid']" v-if="viewTable === 'list'" class="size-6" title="Grid"/>
                        <component :is="optionsMap['List']" v-else class="size-6" title="List"/>
                    </PrimaryButton> -->
                    <PrimaryButton v-for="(entity, key) in entityMap" :key="`create_entity_${key}`" class="flex flex-row gap-1 items-center medium" @click.prevent="toogleModal({show:true, entity: key.toLowerCase(), type:'create', id:null})">
                        <component :is="optionsMap['Plus']" class="size-6"></component>
                        <span>{{ singularName(key) }}</span>
                    </PrimaryButton>
                </div>
            </div>
            <section v-if="showFilter" class="flex flex-col gap-2 items-start transition-all duration-300 mb-6">
                <header class="flex flex-row justify-start items-center gap-2 text-primary font-medium text-sm">
                    <component :is="optionsMap['Filter']" class="size-6" />
                    <span class="uppercase">Filters</span>
                </header>
                <component :is="formMap['Filter']" :form="filters" :columns="filterColumns" :data="data" class="bg-white rounded-lg w-full pt-2 pb-4 px-8 flex flex-row justify-center items-end"/>
            </section>
            <section v-if="viewTable === 'list'">
                <Table :columns="columns" :data="filteredItems" :sortColumn="sortColumn" :sortDirection="sortDirection" @sortByColumn="sortByColumn" @openModal="toogleModal">
                </Table>
            </section>
            <section v-if="viewTable === 'grid'">
                <Grid :data="filteredItems" @openModal="toogleModal"></Grid>
            </section>
            <Modal :show="showModal" @close="toogleModal({show:false})">
                <div class="flex flex-col items-center py-10 px-32">
                    <h2 class="font-medium leading-relaxed text-3xl md:text-4xl text-transparent bg-clip-text bg-primary mb-4">
                        {{ modal.title }}
                    </h2>
                    <div class="mt-6 w-full">
                        <p v-if="modal.action === 'delete'" class="bg-red-100 text-red-800 rounded shadow mb-4 p-4 w-full text-center"> Are you sure to delete this {{ singularName(showEntity).toLowerCase() }}?</p>
                        <div class="text-sm text-gray-600 w-full">
                            <component :is="formMap[capitalize(showEntity)]" :form="form" :columns="columns" :data="data" :submit="modal.submit" :buttonLabel="modal.button" />
                        </div>
                    </div>
                </div>
            </Modal>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
    import { Head, router, Link, usePage } from '@inertiajs/vue3'
    import { reactive, ref, nextTick, computed } from 'vue'
    import FlashMessage from '@/Components/FlashMessage.vue'
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
    import Modal from '@/Components/Modal.vue'
    import Table from '@/Components/Table.vue'
    import Grid from '@/Components/Grid.vue'
    import TextInput from '@/Components/ItemForm/TextInput.vue'
    import { entityMap, optionsMap, formMap, menuMap } from '@/Utils/map.js'
    import { capitalize } from '@/Utils/helpers.js'

    const props = defineProps({
        nameData: String,
        description: String,
        data: Array,
        columns: Object,
        filterColumns: Object,
    })

    const searchQuery = ref('')

    const page = usePage()
    const showEntity = ref('topics')
    const showModal = ref(false)
    const showFilter = ref(false)
    const form = reactive({})
    const filters = reactive({})
    const viewTable = ref('grid')
    const sortColumn = ref('name')
    const sortDirection = ref('asc')

    const filteredItems = computed(() => {
        const query = searchQuery.value.toLowerCase()

        let filtered = props.data.filter(item =>
            Object.values(item).some(value =>
                String(value).toLowerCase().includes(query)
            )
        )
        if(sortColumn.value){
            filtered = filtered.sort((a,b) => {
                if (a[sortColumn.value] < b[sortColumn.value]) {
                    return sortDirection.value === 'asc' ? -1 : 1;
                }
                if (a[sortColumn.value] > b[sortColumn.value]) {
                    return sortDirection.value === 'asc' ? 1 : -1;
                }
                return 0;
            })
        }

        return filtered
    })

    const modal = reactive({
        title: `Create ${singularName(showEntity.value)}`,
        action: 'create',
        button: 'Create',
        id: null,
        submit: () => {
            const url = modal.action === 'create' ? `/${showEntity.toLowerCase()}` : `/${showEntity.toLowerCase()}/${modal.id}`
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
    resetFilters()

    function singularName(entity) {
        return entity.endsWith('s') ? entity.slice(0, -1) : entity
    }
    function sortByColumn(column){
        if (sortColumn.value === column) {
            sortDirection.value = sortDirection.value === 'asc' ? 'desc' : 'asc';
        } else {
            sortColumn.value = column;
            sortDirection.value = 'asc';
        }
    }

    function resetForm(item = null){
        Object.keys(props.columns).forEach(key => {
            form[key] = item ? item[key] : ''
        })
        if(item === null){
            form['disabled'] = false
        }
    }

    function resetFilters(item = null){
        Object.keys(props.filterColumns).forEach(key => {
            if(props.filterColumns[key].type === 'array'){
                props.filterColumns[key].elements.forEach(element => {
                    filters[element.id] = item ? item[key] : ''
                })
            } else {
                filters[key] = item ? item[key] : ''
            }
        })
    }

    function toogleModal({show, entity = 'topics', type = 'create', id = null}){
        showModal.value = show
        showEntity.value = entity
        if(show){
            modal.action = type
            modal.id = id
            modal.title = type === 'create'? `Create ${singularName(entity)}`: type === 'edit'? `Update ${singularName(entity)}`: `Delete ${singularName(entity)}`
            modal.button = type === 'create' ? 'Create': type === 'edit'? 'Update':'Delete'
            form.disabled = type === 'delete' ? true : false
            if (type !== 'create') {
                const item = props.data.find(element => element.id === id)
                resetForm(item)
            } else {
                resetForm()
            }
        }
    }

    function toogleView(){
        viewTable.value = viewTable.value === 'list' ? 'grid' : 'list'
    }

    function toogleFilter(){
        showFilter.value = !showFilter.value;
    }

    function hasValidationErrors(){
        return page.props.errors && Object.keys(page.props.errors).length > 0
    }

</script>
