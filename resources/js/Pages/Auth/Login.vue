<template>
    <GuestLayout>
        <Head title="Log in" />
        <section class="bg-gradient-to-b from-darkPrimary to-lightPrimary min-h-screen flex items-center justify-center">
            <transition enter-active-class="transition ease-out duration-500" enter-from-class="opacity-0 translate-y-5" enter-to-class="opacity-100 translate-y-0" >
                <div v-show="showForm" class="max-w-xs lg:max-w-6xl w-full flex flex-col md:flex-row items-center md:items-center text-white gap-32">
                    <div class="flex flex-col w-full md:w-1/2 pr-8">
                        <h1 class="text-4xl font-bold mb-4 leading-tight">Sign in to your account</h1>
                        <p class="text-lg text-gray-200">Enter your credentials to access your account.</p>
                    </div>
                    <!-- Form -->
                    <div class="w-full md:w-1/2 bg-white text-primary rounded-2xl shadow-md p-8">
                        <!-- General status -->
                        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
                            {{ status }}
                        </div>

                        <form @submit.prevent="submit">
                            <div class="space-y-4">
                                <div>
                                    <InputLabel for="email" value="Email:" class="text-lightPrimary text-[1.1rem] mb-2"/>
                                    <TextInput id="email" type="email" class="mt-1 block w-full focus:border-lightPrimary focus:ring-lightPrimary" v-model="form.email" required autofocus autocomplete="username" />
                                    <InputError class="mt-1" :message="form.errors.email" />
                                </div>

                                <div>
                                    <InputLabel for="password" value="Password:" class="text-lightPrimary text-[1.1rem] mb-2"/>
                                    <TextInput id="password" type="password" class="mt-1 block w-full focus:border-lightPrimary focus:ring-lightPrimary" v-model="form.password" required autocomplete="current-password" />
                                    <InputError class="mt-1" :message="form.errors.password" />
                                </div>

                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-4">
                                <label class="flex items-center space-x-2">
                                    <Checkbox name="remember" v-model:checked="form.remember" class="accent-primary text-primary focus:ring-primary"/>
                                    <span class="text-sm">Remember me</span>
                                </label>

                                <Link v-if="canResetPassword" :href="route('password.request')" class="mt-2 sm:mt-0 text-sm text-primary hover:underline focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                                    Forgot your password?
                                </Link>
                                </div>

                                <div class="mt-6">
                                <PrimaryButton class="w-full bg-primary hover:bg-white hover:border-primary hover:text-primary" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Log in
                                </PrimaryButton>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </transition>
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
    import { ref, onMounted } from 'vue';

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

    const showForm = ref(false);
    onMounted(() => {
        // Show the form after a short delay
        setTimeout(() => {
            showForm.value = true;
        }, 300);
    });

</script>
