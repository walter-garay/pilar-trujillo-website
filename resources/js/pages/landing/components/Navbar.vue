<template>
    <header
        :class="[
            'fixed top-0 z-50 w-full border-b border-border/20 bg-background/75 backdrop-blur transition-transform duration-300',
            { '-translate-y-full': hideNavbar },
        ]"
    >
        <nav class="mx-auto flex h-16 max-w-7xl items-center justify-center px-4">
            <div class="hidden items-center gap-1 md:flex">
                <UButton variant="ghost" color="primary" to="#">Reencuentro</UButton>
                <DropdownMenu>
                    <DropdownMenuTrigger as-child>
                        <UButton color="primary" variant="ghost" label="Multimedia" trailing-icon="i-heroicons-chevron-down-20-solid" />
                    </DropdownMenuTrigger>
                    <DropdownMenuContent>
                        <DropdownMenuItem v-for="item in dropdownItems" :key="item.to" as-child>
                            <UButton variant="ghost" color="primary" :to="item.to" class="w-full justify-start">
                                <UIcon :name="item.icon" class="mr-2 h-4 w-4" />
                                {{ item.label }}
                            </UButton>
                        </DropdownMenuItem>
                    </DropdownMenuContent>
                </DropdownMenu>
                <UButton variant="ghost" color="primary" to="/publicaciones">Publicaciones</UButton>
                <UButton variant="ghost" color="primary" to="#sponsors">Sponsors</UButton>
                <UButton variant="ghost" color="primary" to="#">Contacto</UButton>
            </div>
        </nav>
    </header>
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
