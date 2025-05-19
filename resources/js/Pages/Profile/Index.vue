<template>
    <Head title="My Profile" />
    <AuthenticatedLayout>
        <div class="flex flex-col items-start justify-start">
            <section class="flex flex-col w-full pr-8">
                <h1 class="font-medium leading-relaxed text-4xl md:text-5xl text-transparent bg-clip-text bg-gradient-to-r from-darkPrimary to-lightPrimary mb-4">My Profile</h1>
                <p class="text-gray-600 font-normal text-lg tracking-wide">Organize your profile efficiently</p>
            </section>
            <section class="mt-6 w-1/3">
                <article class="flex flex-row gap-10 items-center justify-start bg-white shadow-md rounded-lg p-6 text-center border-2 border-lightPrimary cursor-pointer hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 hover:scale-105">
                    <img :src="user.avatar" alt="User Avatar" class="rounded-full bg-gray-200 w-24 h-24" />
                    <div class="flex flex-col items-start">
                        <span class="text-2xl font-semibold text-gray-800">{{ page.props.auth.user.name }}</span>
                        <span class="text-md font-normal text-gray-600">{{ page.props.auth.user.email }}</span>
                        <PrimaryButton class="mt-4 bg-primary">
                            Edit Profile
                        </PrimaryButton>
                    </div>
                </article>
            </section>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
    import { Head } from '@inertiajs/vue3'
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import { usePage } from '@inertiajs/vue3'
    import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'

    const page = usePage()
    const user = page.props.auth.user

</script>
