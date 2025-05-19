<template>
    <GuestLayout>
        <Head title="Register" />
        <section class="bg-gradient-to-b from-darkPrimary to-lightPrimary min-h-screen flex items-center justify-center px-6">
            <transition enter-active-class="transition ease-out duration-500" enter-from-class="opacity-0 translate-y-5" enter-to-class="opacity-100 translate-y-0">
                <div v-show="showForm" class="max-w-6xl w-full flex flex-col md:flex-row items-center gap-20 text-white">
                    <!-- Left side (Text) -->
                    <div class="flex flex-col w-full md:w-1/2 text-center md:text-left">
                        <h1 class="text-4xl md:text-5xl leading-md text-shadow-sm mb-4">Welcome to {{ $page.props.appName }}</h1>
                        <p class="text-lg md:text-xl text-gray-100">
                            Create your account and start organizing your knowledge and ideas today.
                        </p>
                    </div>

                    <!-- Right side (Form) -->
                    <div class="w-full md:w-1/2 bg-white text-primary rounded-2xl shadow-lg p-8 md:p-10">
                        <form @submit.prevent="submit" class="space-y-6">
                            <div>
                                <InputLabel for="name" value="Name:" class="text-lightPrimary font-semibold text-lg mb-2" />
                                <TextInput id="name" type="text" class="mt-1 block w-full focus:border-lightPrimary focus:ring-lightPrimary" v-model="form.name" required autofocus autocomplete="name" />
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div>
                                <InputLabel for="email" value="Email:" class="text-lightPrimary font-semibold text-lg mb-2" />
                                <TextInput id="email" type="email" class="mt-1 block w-full focus:border-lightPrimary focus:ring-lightPrimary" v-model="form.email" required autocomplete="username" />
                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>

                            <div>
                                <InputLabel for="password" value="Password:" class="text-lightPrimary font-semibold text-lg mb-2" />
                                <TextInput id="password" type="password" class="mt-1 block w-full focus:border-lightPrimary focus:ring-lightPrimary" v-model="form.password" required autocomplete="new-password" />
                                <InputError class="mt-2" :message="form.errors.password" />
                            </div>

                            <div>
                                <InputLabel for="password_confirmation" value="Confirm Password:" class="text-lightPrimary font-semibold text-lg mb-2" />
                                <TextInput id="password_confirmation" type="password" class="mt-1 block w-full focus:border-lightPrimary focus:ring-lightPrimary" v-model="form.password_confirmation" required autocomplete="new-password" />
                                <InputError class="mt-2" :message="form.errors.password_confirmation" />
                            </div>

                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mt-6">
                                <Link :href="route('login')" class="text-sm text-primary underline hover:text-lightPrimary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                                    Already have an account?
                                </Link>

                                <PrimaryButton class="w-full md:w-auto ms-0 md:ms-4 bg-primary hover:bg-white hover:border-primary hover:text-primary" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" >
                                    Register
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
    import InputError from '@/Components/ItemForm/InputError.vue';
    import InputLabel from '@/Components/ItemForm/InputLabel.vue';
    import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
    import TextInput from '@/Components/ItemForm/TextInput.vue';
    import { Head, Link, useForm } from '@inertiajs/vue3';
    import { ref, onMounted } from 'vue';

    const form = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    const submit = () => {
        form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
        });
    };

    const showForm = ref(false);
    onMounted(() => {
        setTimeout(() => {
        showForm.value = true;
        }, 200);
    });
</script>
