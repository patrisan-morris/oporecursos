<template>
    <GuestLayout>
        <Head title="Log in" />
        <section class="bg-gradient-to-b from-darkPrimary to-lightPrimary min-h-screen w-full flex flex-col justify-center items-center text-center relative px-6">
            <div class="max-w-4xl w-full flex flex-row justify-center items-center text-transparent bg-clip-text bg-gradient-to-r from-white to-lightbg ">
                <div class="w-full md:w-1/2 flex flex-col items-start justify-start">
                    <h1 class="text-left text-3xl md:text-4xl text-white text-shadow-sm leading-md md:leading-[5rem]">
                        Sign in to your account
                    </h1>
                    <p class="text-lg md:text-lg text-white">
                        Enter your credentials to access your account.
                    </p>
                </div>
                <div class="w-full md:w-1/2 bg-white rounded-xl shadow-lg p-10">
                    <form @submit.prevent="submit">
                        <div class="flex flex-col items-start gap-2">
                            <InputLabel class="text-primary text-[20px] tracking-wide" for="email" value="Email:" />
                            <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username"/>
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div class="flex flex-col items-start gap-2 mt-4">
                            <InputLabel class="text-primary text-[20px] tracking-wide" for="password" value="Password:" />
                            <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password"/>
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <div class="flex flex-row justify-between gap-2 mt-4">
                            <div class="mt-4 block">
                                <label class="flex items-center">
                                    <Checkbox name="remember" v-model:checked="form.remember" class="pointer"/>
                                    <span class="ms-2 text-md text-primary">Remember me</span>
                                </label>
                            </div>
                            <div class="mt-4">
                                <Link v-if="canResetPassword" :href="route('password.request')" class="text-md text-primary underline hover:text-lightPrimary focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:ring-0">
                                    Forgot your password?
                                </Link>
                            </div>
                        </div>
                        <div class="mt-10 flex items-center justify-center">
                            <PrimaryButton class="ms-4 bg-primary" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Log in
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </GuestLayout>
</template>
<script setup>
    import Checkbox from '@/Components/Checkbox.vue';
    import GuestLayout from '@/Layouts/GuestLayout.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { Head, Link, useForm } from '@inertiajs/vue3';

    defineProps({
        canResetPassword: {
            type: Boolean,
        },
        status: {
            type: String,
        },
    });

    const form = useForm({
        email: '',
        password: '',
        remember: false,
    });

    const submit = () => {
        form.post(route('login'), {
            onFinish: () => form.reset('password'),
        });
    };
</script>
