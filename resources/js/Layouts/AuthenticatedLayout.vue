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
                                <component :is="menuMap[item.Icon]" class="text-white size-6 fill-white" />
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
                            <component :is="menuMap[item.Icon]" class="text-white size-6 fill-white" />
                            <span class="ms-3 text-white tracking-wider text-md">{{ item.name }}</span>
                        </Link>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="sm:ml-64 bg-gray-100 min-h-screen">
        <main class="px-12 py-10">
            <slot />
        </main>
    </div>
</template>
<script setup>

    import { ref } from 'vue';
    import IconLogo from '@/Components/Logos/IconLogo.vue'
    import Dropdown from '@/Components/Menus/Dropdown.vue'
    import DropdownLink from '@/Components/Menus/DropdownLink.vue'
    import NavLink from '@/Components/Menus/NavLink.vue'
    import ResponsiveNavLink from '@/Components/Menus/ResponsiveNavLink.vue'
    import { usePage, Link } from '@inertiajs/vue3'
    import { menuMap } from '@/Utils/map.js'

    const showingNavigationDropdown = ref(false)

    const menuTop = [
        { name: 'Dashboard', href: '/dashboard', Icon:'Dashboard' },
        { name: 'MindExplorer', href: '/mindexplorer', Icon:'MindExplorer'}
        /*{ name: 'Topics', href: '/topics', Icon:'Topics' },
        { name: 'Lessons', href: '/lessons', Icon:'Lessons' },
        { name: 'Resources', href: '/resources', Icon:'Resources' },
        { name: 'Users', href: '/users', Icon:'Users' },*/
    ]

    const menuBottom = [
        { name: usePage().props.auth.user.name, href: '/profile', Icon:'User' },
        { name: 'Log out', href: '/logout', Icon:'LogOut' },
    ]
</script>
