<template>

    <aside class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gradient-to-b from-darkPrimary to-lightPrimary flex flex-col justify-between">
            <div class="">
                <Link class="flex flex-row justify-start items-center p-2" href="/">
                    <IconLogo class="size-12 fill-current text-white"/>
                    <h1 class="text-3xl font-light text-white ml-1 tracking-widest mt-1 text-shadow-sm">{{$page.props.appName}}</h1>
                </Link>
                <nav class="py-4 px-2">
                    <ul class="space-y-2">
                        <li v-for="item in menuTop" :key="item.name" :class="['py-2 px-4 rounded-md hover:bg-white/10',$page.url.startsWith(item.href) ? 'bg-white/30 hover:bg-white/30' : '' ]" >
                            <Link :href="item.href" class="flex items-center group">
                                <component :is="item.Icon" class="text-white size-6 fill-white" />
                                <span class="ms-3 text-white tracking-wider text-md">{{ item.name }}</span>
                            </Link>
                        </li>
                    </ul>
                </nav>
            </div>
            <nav class="py-4 px-2">
                <ul class="space-y-2">
                    <li v-for="item in menuBottom" :key="item.name" :class="['py-2 px-4 rounded-md hover:bg-white/10',$page.url.startsWith(item.href) ? 'bg-white/30 hover:bg-white/30' : '' ]" >
                        <Link :href="item.href" class="flex items-center group">
                            <component :is="item.Icon" class="text-white size-6 fill-white" />
                            <span class="ms-3 text-white tracking-wider text-md">{{ item.name }}</span>
                        </Link>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="p-4 sm:ml-64">
        <main>
            <slot />
        </main>
    </div>

</template>
<script setup>

    import { ref } from 'vue';
    import IconLogo from '@/Components/Logos/IconLogo.vue'
    import DashboardIcon from '@/Components/Icons/Dashboard.vue'
    import TopicsIcon from '@/Components/Icons/Topics.vue'
    import ResourcesIcon from '@/Components/Icons/Resources.vue'
    import UsersIcon from '@/Components/Icons/Users.vue'
    import SettingsIcon from '@/Components/Icons/Settings.vue'
    import LogOutIcon from '@/Components/Icons/LogOut.vue'
    import Dropdown from '@/Components/Dropdown.vue'
    import DropdownLink from '@/Components/DropdownLink.vue'
    import NavLink from '@/Components/NavLink.vue'
    import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
    import { Link } from '@inertiajs/vue3'

    const showingNavigationDropdown = ref(false)

    const menuTop = [
        { name: 'Dashboard', href: '/dashboard', Icon:DashboardIcon },
        { name: 'Topics', href: '/topics', Icon:TopicsIcon },
        { name: 'Resources', href: '/resources', Icon:ResourcesIcon },
        { name: 'Users', href: '/users', Icon:UsersIcon },
    ]

    const menuBottom = [
        { name: 'Settings', href: '/settings', Icon:SettingsIcon },
        { name: 'Log out', href: '/logout', Icon:LogOutIcon },
    ]
</script>
