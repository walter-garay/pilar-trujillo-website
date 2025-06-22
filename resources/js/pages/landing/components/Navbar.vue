<template>
    <header
        :class="[
            'fixed top-0 z-50 w-full border-b border-border/20 bg-background/75 backdrop-blur transition-transform duration-300',
            { '-translate-y-full': hideNavbar },
        ]"
    >
        <nav class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4">
            <div class="flex items-center gap-3">
                <div class="flex h-8 w-8 items-center justify-center rounded-full bg-primary font-bold text-primary-foreground">PT</div>
                <span class="text-lg font-semibold text-foreground">Pilar Trujillo</span>
            </div>
            <div class="hidden items-center gap-1 md:flex">
                <UButton variant="ghost" color="primary" to="#">Reencuentro</UButton>
                <UButton variant="ghost" color="primary" to="/multimedia">Multimedia</UButton>
                <UButton variant="ghost" color="primary" to="/publicaciones">Publicaciones</UButton>
                <UButton variant="ghost" color="primary" to="#sponsors">Sponsors</UButton>
                <UButton variant="ghost" color="primary" to="#">Contacto</UButton>
            </div>
        </nav>
    </header>
</template>

<script setup lang="ts">
import { onMounted, onUnmounted, ref } from 'vue';

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
