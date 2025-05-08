<template>
    <GuestLayout>
        <Head title="Forgot Password" />

        <section class="bg-gradient-to-b from-darkPrimary to-lightPrimary min-h-screen flex items-center justify-center px-6">
            <transition enter-active-class="transition ease-out duration-500" enter-from-class="opacity-0 translate-y-5" enter-to-class="opacity-100 translate-y-0">
                <div v-show="showForm" class="max-w-6xl w-full flex flex-col md:flex-row items-center gap-20 text-white">
                    <!-- Left side (Text) -->
                    <div class="flex flex-col w-full md:w-1/2 text-center md:text-left">
                        <h1 class="text-4xl md:text-5xl leading-md text-shadow-sm mb-4">Forgot your password?</h1>
                        <p class="text-lg md:text-xl text-gray-300">
                            No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                        </p>
                    </div>
                    <!-- Right side (Form) -->
                    <div class="w-full md:w-1/2 bg-white text-primary rounded-2xl shadow-md p-8">
                        <!-- General status -->
                        <transition enter-active-class="transition ease-in duration-500" enter-from-class="opacity-0 scale-x-0" enter-to-class="opacity-100 scale-x-100" >
                            <div v-if="status" class="mb-4 text-sm font-medium text-green-600" >
                                {{ status }}
                            </div>
                        </transition>

                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="email" value="Email:" class="text-lightPrimary font-semibold text-lg"/>
                                <TextInput id="email" type="email" class="mt-1 block w-full focus:border-lightPrimary focus:ring-lightPrimary" v-model="form.email" required autofocus autocomplete="username" />
                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>

                            <div class="mt-4 flex items-center justify-end">
                                <PrimaryButton class="w-full bg-primary hover:bg-white hover:text-primary hover:border-primary" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" >
                                    Email Password Reset Link
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
    import { ref, onMounted } from 'vue';

    defineProps({
        status: {
            type: String,
        },
    });

    const form = useForm({
        email: '',
    });

    const submit = () => {
        form.post(route('password.email'));
    };

    const showForm = ref(false);
    onMounted(() => {
        // Show the form after a short delay
        setTimeout(() => {
            showForm.value = true;
        }, 300);
    });
</script>
