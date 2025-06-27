<script setup lang="ts">
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { BookOpen, BookText, Film, Podcast, Radio, Tv, Users, Star } from 'lucide-vue-next';

const mainNavItems: NavItem[] = [
    {
        title: 'Auspiciadores',
        href: '/admin/auspiciadores',
        icon: Users,
    },
    {
        title: 'Publicaciones',
        href: '/admin/publicaciones',
        icon: BookText,
    },
    {
        title: 'Televisión',
        href: '/admin/multimedia/television',
        icon: Tv,
    },
    {
        title: 'Podcast',
        href: '/admin/multimedia/podcast',
        icon: Podcast,
    },
    {
        title: 'Audiolibros',
        href: '/admin/multimedia/audiolibros',
        icon: BookOpen,
    },
    {
        title: 'Radio',
        href: '/admin/multimedia/radio',
        icon: Radio,
    },
    {
        title: 'Videos exclusivos',
        href: '/admin/multimedia/exclusivos',
        icon: Star,
    },
    {
        title: 'Videos cortos',
        href: '/admin/multimedia/cortos',
        icon: Film,
    },
];

// const footerNavItems: NavItem[] = [
//     {
//         title: 'Github Repo',
//         href: 'https://github.com/laravel/vue-starter-kit',
//         icon: Folder,
//     },
//     {
//         title: 'Documentation',
//         href: 'https://laravel.com/docs/starter-kits#vue',
//         icon: BookOpen,
//     },
// ];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('home')">
                            <span class="text-xl font-bold">Reencuentro</span>
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <!-- <NavFooter :items="footerNavItems" /> -->
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
