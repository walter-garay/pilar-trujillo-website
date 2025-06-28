<template>
    <header class="w-full border-b border-border/20 bg-[#fcc633] shadow">
        <nav class="mx-auto flex h-12 max-w-7xl items-center px-4">


            <!-- Enlaces centrados para pantallas grandes -->
            <div class="hidden items-center gap-8 md:flex md:flex-1 md:justify-center">
                <UButton variant="ghost" class="font-bold text-black underline-offset-4 hover:underline" color="primary" to="/">Reencuentro</UButton>
                <UButton variant="ghost" class="font-bold text-black underline-offset-4 hover:underline" color="primary" to="/publicaciones"
                    >Publicaciones</UButton
                >
                <UButton variant="ghost" class="font-bold text-black underline-offset-4 hover:underline" color="primary" to="/galeria"
                    >Galería</UButton
                >
                <DropdownMenu>
                    <DropdownMenuTrigger as-child>
                        <UButton
                            color="primary"
                            class="font-bold text-black"
                            variant="ghost"
                            label="Multimedia"
                            trailing-icon="i-heroicons-chevron-down-20-solid"
                        />
                    </DropdownMenuTrigger>
                    <DropdownMenuContent>
                        <DropdownMenuItem v-for="item in dropdownItems" :key="item.to" as-child>
                            <UButton
                                variant="ghost"
                                color="primary"
                                :to="item.to"
                                class="w-full justify-start text-black underline-offset-4 hover:underline"
                            >
                                <UIcon :name="item.icon" class="mr-2 h-4 w-4" />
                                {{ item.label }}
                            </UButton>
                        </DropdownMenuItem>
                    </DropdownMenuContent>
                </DropdownMenu>
            </div>

            <!-- Botón de menú para móviles -->
            <div class="flex items-center md:hidden">
                <UButton variant="ghost" color="primary" icon="i-heroicons-bars-3" @click="isSidebarOpen = true" class="text-black" />
            </div>
        </nav>
    </header>

    <!-- Franja negra con logo centrado, fuera del header -->
    <div class="mx-40 flex w-full items-center justify-center rounded-lg bg-black shadow-md shadow-gray-400" style="margin: 0 auto">
        <img src="/assets/images/brand/logotipo.png" alt="Reencuentro" class="mx-auto h-8 w-auto py-2" />
    </div>

    <!-- Sidebar para móviles -->
    <Sheet v-model:open="isSidebarOpen">
        <SheetContent side="left" class="w-80 border-r-0 bg-[#fcc633]">
            <SheetHeader class="pb-6">
                <SheetTitle class="text-left">
                    <img src="/assets/images/brand/logotipo.png" alt="Reencuentro" class="h-8 w-auto" />
                </SheetTitle>
                <SheetClose />
            </SheetHeader>

            <div class="flex flex-col space-y-4">
                <!-- Enlaces principales -->
                <div class="space-y-2">
                    <UButton
                        variant="ghost"
                        color="primary"
                        to="/"
                        class="w-full justify-start text-lg font-bold text-black"
                        @click="isSidebarOpen = false"
                    >
                        <UIcon name="i-heroicons-home" class="mr-3 h-5 w-5" />
                        Reencuentro
                    </UButton>

                    <UButton
                        variant="ghost"
                        color="primary"
                        to="/publicaciones"
                        class="w-full justify-start text-lg font-bold text-black"
                        @click="isSidebarOpen = false"
                    >
                        <UIcon name="i-heroicons-document-text" class="mr-3 h-5 w-5" />
                        Publicaciones
                    </UButton>

                    <UButton
                        variant="ghost"
                        color="primary"
                        to="/galeria"
                        class="w-full justify-start text-lg font-bold text-black"
                        @click="isSidebarOpen = false"
                    >
                        <UIcon name="i-heroicons-photo" class="mr-3 h-5 w-5" />
                        Galería
                    </UButton>
                </div>

                <!-- Sección Multimedia -->
                <div class="space-y-2">
                    <div class="px-3 py-2">
                        <h3 class="text-lg font-bold text-black">Multimedia</h3>
                    </div>
                    <UButton
                        v-for="item in dropdownItems"
                        :key="item.to"
                        variant="ghost"
                        color="primary"
                        :to="item.to"
                        class="ml-4 w-full justify-start text-base text-black"
                        @click="isSidebarOpen = false"
                    >
                        <UIcon :name="item.icon" class="mr-3 h-4 w-4" />
                        {{ item.label }}
                    </UButton>
                </div>
            </div>
        </SheetContent>
    </Sheet>
</template>

<script setup lang="ts">
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger } from '@/components/ui/dropdown-menu';
import { Sheet, SheetClose, SheetContent, SheetHeader, SheetTitle } from '@/components/ui/sheet';
import { useMediaTabs } from '@/composables/useMediaTabs';
import { computed, onMounted, onUnmounted, ref } from 'vue';

const { items: mediaTabs } = useMediaTabs();

const dropdownItems = computed(() =>
    mediaTabs.value
        .filter((tab) => !tab.disabled)
        .map((tab) => ({
            label: tab.label,
            to: `/multimedia/${tab.value}`,
            icon: tab.icon,
        })),
);

const isSidebarOpen = ref(false);
const hideNavbar = ref(false);
let lastScroll = 0;

const handleScroll = () => {
    const currentScroll = window.scrollY;
    if (currentScroll > lastScroll && currentScroll > 60) {
        hideNavbar.value = true;
    } else {
        hideNavbar.value = false;
    }
    lastScroll = currentScroll;
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});
onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>
