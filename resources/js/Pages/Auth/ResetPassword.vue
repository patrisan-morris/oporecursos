<template>
    <GuestLayout>
        <Head title="Reset Password" />
        <section class="bg-gradient-to-b from-darkPrimary to-lightPrimary min-h-screen flex items-center justify-center">
            <transition enter-active-class="transition ease-out duration-500" enter-from-class="opacity-0 translate-y-5" enter-to-class="opacity-100 translate-y-0" >
                <div v-show="showForm" class="max-w-xs lg:max-w-6xl w-full flex flex-col md:flex-row items-center md:items-center text-white gap-32">
                    <!-- Left side (Text) -->
                    <div class="flex flex-col w-full md:w-1/2 pr-8">
                        <h1 class="text-4xl md:text-5xl leading-md text-shadow-sm mb-4">Reset your password</h1>
                        <p class="text-lg md:text-xl text-gray-100">Enter your new password below to access your account.</p>
                    </div>
                    <!-- Right side (Form) -->
                    <div class="w-full md:w-1/2 bg-white text-primary rounded-2xl shadow-md p-8">
                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="email" value="Email:" class="text-lightPrimary font-semibold text-lg"/>
                                <TextInput id="email" type="email" class="mt-1 block w-full focus:border-lightPrimary focus:ring-lightPrimary" v-model="form.email" required autofocus autocomplete="username" />
                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="password" value="Password:" class="text-lightPrimary font-semibold text-lg"/>
                                <TextInput id="password" type="password" class="mt-1 block w-full focus:border-lightPrimary focus:ring-lightPrimary" v-model="form.password" required autocomplete="new-password" />
                                <InputError class="mt-2" :message="form.errors.password" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="password_confirmation" value="Confirm Password:" class="text-lightPrimary font-semibold text-lg"/>
                                <TextInput id="password_confirmation" type="password" class="mt-1 block w-full focus:border-lightPrimary focus:ring-lightPrimary" v-model="form.password_confirmation" required autocomplete="new-password" />
                                <InputError class="mt-2" :message="form.errors.password_confirmation" />
                            </div>

                            <div class="mt-4 flex items-center justify-end">
                                <PrimaryButton class="w-full bg-primary hover:bg-white hover:border-primary hover:text-primary" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" >
                                    Reset Password
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </transition>
        </section>
    </GuestLayout>
</template>
<script setup>
    import GuestLayout from '@/Layouts/GuestLayout.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { Head, useForm } from '@inertiajs/vue3';

    const props = defineProps({
        email: {
            type: String,
            required: true,
        },
        token: {
            type: String,
            required: true,
        },
    });

    const form = useForm({
        token: props.token,
        email: props.email,
        password: '',
        password_confirmation: '',
    });

    const submit = () => {
        form.post(route('password.store'), {
            onFinish: () => form.reset('password', 'password_confirmation'),
        });
    };
</script>
