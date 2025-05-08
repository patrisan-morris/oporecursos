<template>
    <Head title="Welcome" />
    <GuestLayout>
        <!-- Hero Section -->
        <section class="bg-gradient-to-b from-darkPrimary to-lightPrimary min-h-screen w-full flex flex-col justify-center items-center text-center relative">
            <div class="max-w-6xl w-full flex flex-row justify-center text-transparent bg-clip-text bg-gradient-to-r from-white to-lightbg ">
                <div class="w-full md:w-1/2 flex flex-col items-start justify-start">
                    <h1 class="text-left text-5xl md:text-6xl text-white text-shadow-sm mb-6 leading-md md:leading-[5rem]">
                        Organize your Knowledge. Build your Future.
                    </h1>
                    <p class="text-xl md:text-2xl text-white mb-8">
                        The smarter way to manage your study resources.
                    </p>
                    <div class="flex space-x-4">
                        <Link href="/register">
                            <PrimaryButton class="hover:text-lightPrimary">Get Started</PrimaryButton>
                        </Link>
                    </div>
                </div>
                <div class="w-full md:w-1/2 bg-white rounded-xl shadow-lg">
                </div>
            </div>
            <div class="absolute -bottom-24 left-0 w-full h-28 bg-white transform -skew-y-3 origin-top-left"></div>
        </section>

        <!-- Features Section -->
        <section class="flex flex-col justify-center py-20 w-full bg-white text-center px-6">
            <h2 class="font-medium leading-relaxed md:leading-[4.75rem] text-4xl md:text-5xl text-transparent bg-clip-text bg-gradient-to-r from-darkPrimary to-lightPrimary mb-12">
                Why MindBank?
            </h2>

            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <div class="flex flex-col justify-center items-center shadow-md border-2 border-lightPrimary p-8 pb-10 rounded-lg  hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 hover:scale-105">
                    <SaveIcon class="m-2 size-12 text-primary"></SaveIcon>
                    <h3 class="text-primary text-2xl font-bold mb-4">Save Resources</h3>
                    <p class="text-gray-600 font-normal font-sans tracking-wide">
                        Collect all your study materials in one secure place.
                    </p>
                </div>

                <div class="flex flex-col justify-center items-center shadow-md border-2 border-lightPrimary p-8 pb-10 rounded-lg  hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 hover:scale-105">
                    <CategorizeIcon class="m-2 size-12 text-primary"></CategorizeIcon>
                    <h3 class="text-primary text-2xl font-bold mb-4">Categorize Topics</h3>
                    <p class="text-gray-600 font-normal  font-sans tracking-wide">
                        Organize your resources by topics, exams or personal projects.
                    </p>
                </div>

                <div class="flex flex-col justify-center items-center shadow-md border-2 border-lightPrimary p-8 pb-10 rounded-lg hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2 hover:scale-105">
                    <AccessIcon class="m-2 size-12 text-primary"></AccessIcon>
                    <h3 class="text-primary text-2xl font-bold mb-4">Access Anywhere</h3>
                    <p class="text-gray-600 font-normal font-sans tracking-wide">
                        Access your materials anytime, anywhere, from any device.
                    </p>
                </div>
            </div>
        </section>

        <!-- Call to Action Section -->
        <section class="bg-gradient-to-b from-primary to-lightPrimary py-20 text-center px-6 relative">

            <WaveBackground fromColor="#ffffff" toColor="#ffffff" height="h-24"/>

            <div class="mt-20 flex flex-col items-center justify-center">
                <h2 class="leading-relaxed md:leading-[4.75rem] text-5xl md:text-6xl text-white text-shadow-sm mb-6">
                    Ready to start your journey?
                </h2>
                <p class="font-sans text-xl text-white mb-8">
                    Join MindBank today and level up your learning!
                </p>
                <Link href="/register">
                    <PrimaryButton class="hover:text-primary">Create your Account</PrimaryButton>
                </Link>
            </div>

        </section>
    </GuestLayout>
</template>

<script setup>
    import GuestLayout from '@/Layouts/GuestLayout.vue';
    import SaveIcon from '@/Components/Icons/Save.vue';
    import CategorizeIcon from '@/Components/Icons/Categorize.vue';
    import AccessIcon from '@/Components/Icons/Access.vue';
    import WaveBackground from '@/Components/Backgrounds/Wave.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import { Head, Link } from '@inertiajs/vue3';
</script>
