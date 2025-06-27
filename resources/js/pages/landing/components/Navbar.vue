<template>
    <header class="w-full border-b border-border/20 bg-[#fcc633] shadow">
        <nav class="mx-auto flex h-12 max-w-7xl items-center justify-center px-4">
            <div class="hidden items-center gap-8 md:flex">
                <UButton variant="ghost" class="font-bold text-black" color="primary" to="/">Reencuentro</UButton>
                <UButton variant="ghost" class="font-bold text-black" color="primary" to="/publicaciones">Publicaciones</UButton>
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
                            <UButton variant="ghost" color="primary" :to="item.to" class="w-full justify-start text-black">
                                <UIcon :name="item.icon" class="mr-2 h-4 w-4" />
                                {{ item.label }}
                            </UButton>
                        </DropdownMenuItem>
                    </DropdownMenuContent>
                </DropdownMenu>

                <!-- <UButton variant="ghost" color="primary" to="">Auspiciadores</UButton> -->
            </div>
        </nav>
    </header>
    <!-- Franja negra con logo centrado, fuera del header -->
    <div class="mx-40 flex w-full items-center justify-center rounded-lg bg-black shadow-lg shadow-black/60" style="margin: 0 auto">
        <img src="/assets/images/brand/logotipo.png" alt="Reencuentro" class="mx-auto h-8 w-auto py-2" />
    </div>
</template>

<script setup lang="ts">
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger } from '@/components/ui/dropdown-menu';
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
