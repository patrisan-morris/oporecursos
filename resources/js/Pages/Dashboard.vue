<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <div class="m-12 flex flex-col items-start justify-start">
            <section class="flex flex-col w-full pr-8">
                <h1 class="font-medium leading-relaxed text-4xl md:text-5xl text-transparent bg-clip-text bg-gradient-to-r from-darkPrimary to-lightPrimary mb-4">Welcome to {{ $page.props.appName }}, {{ $page.props.auth.user.name }}</h1>
                <p class="text-gray-600 font-normal text-lg tracking-wide">Organize your ideas and knowledge efficiently</p>
            </section>
            <div class="flex flex-row w-full mt-10">
                <section class="flex flex-col w-full">
                    <h2 class="text-2xl font-semibold text-primary">Overview</h2>
                    <div class="flex flex-row flex-wrap w-full md:w-1/2 justify-between items-stretch gap-4 mt-6">
                        <article v-for="item in overView" :key="item.name" class="flex flex-col flex-1 items-center justify-center bg-white shadow-md rounded-lg p-6 min-w-[160px] text-center border-2 border-lightPrimary cursor-pointer hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 hover:scale-105">
                            <component :is="item.Icon" class="text-primary size-8 mb-2" />
                            <span class="text-lg font-semibold text-gray-800">{{ item.name }}</span>
                            <span class="text-2xl font-bold text-gray-800 mt-1">{{ item.value }}</span>
                        </article>
                    </div>
                </section>
                <section class="flex flex-col w-full">
                    <h2 class="text-2xl font-semibold text-primary">Overview</h2>
                    <div class="flex flex-row flex-wrap w-full md:w-1/2 justify-between items-stretch gap-4 mt-6">
                        <article v-for="item in overView" :key="item.name" class="flex flex-col flex-1 items-center justify-center bg-white shadow-md rounded-lg p-6 min-w-[160px] text-center border-2 border-lightPrimary cursor-pointer hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 hover:scale-105">
                            <component :is="item.Icon" class="text-primary size-8 mb-2" />
                            <span class="text-lg font-semibold text-gray-800">{{ item.name }}</span>
                            <span class="text-2xl font-bold text-gray-800 mt-1">{{ item.value }}</span>
                        </article>
                    </div>
                </section>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import TopicsIcon from '@/Components/Icons/Topics.vue';
    import ResourcesIcon from '@/Components/Icons/Resources.vue';
    import UsersIcon from '@/Components/Icons/Users.vue';
    import { defineProps } from 'vue';

    const props = defineProps({
        topicsCount: {
            type: Number,
            default: 0
        },
        resourcesCount: {
            type: Number,
            default: 0
        },
        usersCount: {
            type: Number,
            default: 0
        },
    });

    const overView = [
        { name: 'Topics', value: props.topicsCount, Icon: TopicsIcon },
        { name: 'Resources', value: props.resourcesCount, Icon: ResourcesIcon },
        { name: 'Users', value: props.usersCount, Icon: UsersIcon },
    ];
</script>
