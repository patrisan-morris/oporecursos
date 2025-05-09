<template>
    <div class="flex min-h-screen w-full flex-col items-center bg-white pt-6 sm:justify-center sm:pt-0 relative">
        <!-- Header -->
        <header class="z-50 max-w-6xl w-full flex flex-row items-center justify-between absolute top-0">
            <Link class="flex flex-row justify-start items-center p-2" href="/">
                <IconLogo class="h-14 w-12 fill-current text-white"/>
                <h1 class="text-4xl font-light text-white ml-2 tracking-widest mt-1 text-shadow-sm">{{$page.props.appName}}</h1>
            </Link>
            <nav class="flex space-x-4 mt-4">
                <Link v-if="$page.component != 'Auth/Login' && !$page.props.auth.user" href="/login">
                    <PrimaryButton class="hover:text-darkPrimary">Log in</PrimaryButton>
                </Link>
                <Link v-if="$page.component != 'Auth/Register' && !$page.props.auth.user" href="/register">
                    <PrimaryButton class="hover:text-darkPrimary">Register</PrimaryButton>
                </Link>
                <Link v-if="$page.component != 'Auth/Register' && $page.component != 'Auth/Login' && $page.props.auth.user" href="/dashboard">
                    <PrimaryButton class="hover:text-darkPrimary">Dashboard</PrimaryButton>
                </Link>
            </nav>
        </header>

        <!-- Main Section -->
        <div class="w-full overflow-hidden bg-white z-20">
            <slot />
        </div>

        <!-- Footer -->
        <footer class="flex flex-row items-center justify-center gap-2 bg-gradient-to-b from-lightPrimary to-lightPrimary py-6 text-center text-white text-sm w-full">
            Developed by <a href="https://patmorris.netlify.app" target="_blank" class="text-darkPrimary font-bold hover:underline focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2">Patricia Morillas</a> © {{ new Date().getFullYear() }} {{ $page.props.appName }}.
        </footer>
    </div>
</template>

<script setup>
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import IconLogo from '@/Components/Logos/IconLogo.vue';
    import NameLogo from '@/Components/Logos/NameLogo.vue';
    import { Link } from '@inertiajs/vue3';
</script>
