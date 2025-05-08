<template>
    <GuestLayout>
        <Head title="Email Verification" />
        <section class="bg-gradient-to-b from-darkPrimary to-lightPrimary min-h-screen flex items-center justify-center">
            <transition enter-active-class="transition ease-out duration-500" enter-from-class="opacity-0 translate-y-5" enter-to-class="opacity-100 translate-y-0" >
                <div v-show="showForm" class="max-w-xs lg:max-w-6xl w-full flex flex-col md:flex-row items-center md:items-center text-white gap-32">
                    <!-- Left side (Text) -->
                    <div class="flex flex-col w-full md:w-1/2 pr-8">
                        <h1 class="text-4xl leading-md text-shadow-sm mb-4">Thanks for signing up!</h1>
                        <p class="text-lg md:text-xltext-gray-100">Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>
                    </div>
                    <!-- Right side (Form) -->
                    <div class="w-full md:w-1/2 bg-white text-primary rounded-2xl shadow-md p-8">
                        <!-- General status -->
                        <div class="mb-4 text-sm font-medium text-green-600" v-if="verificationLinkSent" >
                            A new verification link has been sent to the email address you
                            provided during registration.
                        </div>

                        <form @submit.prevent="submit">
                            <div class="mt-4 flex items-center justify-between">
                                <PrimaryButton class="w-full bg-primary hover:bg-white hover:border-primary hover:text-primary" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" >
                                    Resend Verification Email
                                </PrimaryButton>

                                <Link :href="route('logout')" method="post" as="button" class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" >Log Out</Link >
                            </div>
                        </form>
                    </div>
                </div>
            </transition>
        </section>
    </GuestLayout>
</template>
<script setup>
    import { computed } from 'vue';
    import GuestLayout from '@/Layouts/GuestLayout.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import { Head, Link, useForm } from '@inertiajs/vue3';

    const props = defineProps({
        status: {
            type: String,
        },
    });

    const form = useForm({});

    const submit = () => {
        form.post(route('verification.send'));
    };

    const verificationLinkSent = computed(
        () => props.status === 'verification-link-sent',
    );
</script>
