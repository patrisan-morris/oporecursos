<template>
    <GuestLayout>
        <Head title="Confirm Password" />
        <section class="bg-gradient-to-b from-darkPrimary to-lightPrimary min-h-screen flex items-center justify-center px-6">
            <transition enter-active-class="transition ease-out duration-500" enter-from-class="opacity-0 translate-y-5" enter-to-class="opacity-100 translate-y-0">
                <div v-show="showForm" class="max-w-6xl w-full flex flex-col md:flex-row items-center gap-20 text-white">
                    <!-- Left side (Text) -->
                    <div class="flex flex-col w-full md:w-1/2 text-center md:text-left">
                        <h1 class="text-4xl md:text-5xl leading-md text-shadow-sm mb-4">Confirm your password</h1>
                        <p class="text-lg md:text-xl text-gray-100">
                            This is a secure area of the application. Please confirm your password before continuing.
                        </p>
                    </div>

                    <!-- Right side (Form) -->

                    <div class="w-full md:w-1/2 bg-white text-primary rounded-2xl shadow-lg p-8 md:p-10">
                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="password" value="Password:" class="text-lightPrimary font-semibold text-lg"/>
                                <TextInput id="password" type="password" class="mt-1 block w-full focus:border-lightPrimary focus:ring-lightPrimary" v-model="form.password" required autocomplete="current-password" autofocus/>
                                <InputError class="mt-2" :message="form.errors.password" />
                            </div>

                            <div class="mt-4 flex justify-end">
                                <PrimaryButton class="w-full bg-primary hover:bg-white hover:border-primary hover:text-primary" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Confirm
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
    import { Head, useForm } from '@inertiajs/vue3';
    import { ref, onMounted } from 'vue';

    const form = useForm({
        password: '',
    });

    const submit = () => {
        form.post(route('password.confirm'), {
            onFinish: () => form.reset(),
        });
    };

    const showForm = ref(false);
    onMounted(() => {
        setTimeout(() => {
        showForm.value = true;
        }, 200);
    });
</script>
