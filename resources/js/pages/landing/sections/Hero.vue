<script setup lang="ts">
// Header hero puro, sin tarjeta

import { onMounted, onUnmounted, ref } from 'vue';
import GalleryVerticalCarousel from '../components/GalleryVerticalCarousel.vue';

interface Props {
    socialMediaUrls?: Record<string, string>;
}

const { socialMediaUrls } = defineProps<Props>();

const scrollToVideo = () => {
    const el = document.getElementById('program-presentation');
    if (el) {
        el.scrollIntoView({ behavior: 'smooth' });
    }
};

// Carrusel vertical automático de fotos
const galleryImages = [
    '/assets/images/gallery/1.jpg',
    '/assets/images/gallery/2.jpg',
    '/assets/images/gallery/3.jpg',
    '/assets/images/gallery/4.jpg',
    '/assets/images/gallery/5.jpg',
    '/assets/images/gallery/6.jpg',
    '/assets/images/gallery/7.jpg',
    '/assets/images/gallery/8.jpg',
    '/assets/images/gallery/9.jpg',
    '/assets/images/gallery/10.jpg',
    '/assets/images/gallery/11.jpg',
    '/assets/images/gallery/12.jpg',
    '/assets/images/gallery/14.jpg',
    '/assets/images/gallery/15.jpg',
    '/assets/images/gallery/16.jpg',
];
const currentIndex = ref(0);
let intervalId: any = null;

onMounted(() => {
    intervalId = setInterval(() => {
        currentIndex.value = (currentIndex.value + 1) % galleryImages.length;
    }, 2500);
});
onUnmounted(() => {
    if (intervalId) clearInterval(intervalId);
});
</script>

<template>
    <section class="relative flex h-screen min-h-screen w-full items-center justify-center overflow-hidden bg-background">
        <UContainer class="flex w-full flex-col gap-16 md:flex-row">
            <!-- Columna izquierda -->
            <div class="flex flex-1 flex-col justify-center gap-6">
                <div>
                    <img src="/assets/images/brand/imagotipo_name_left.png" alt="Reencuentro" class="w-92" />

                    <p class="mt-10 max-w-xl pr-36 text-xl text-foreground/80">
                        Un espacio para el diálogo y análisis de la realidad de Huánuco y el Perú. Bajo la dirección de la periodista Pilar Trujillo
                        Martel, "Reencuentro" busca tender puentes y dar voz a nuestra gente.
                    </p>
                </div>
                <div class="mt-2 flex gap-6">
                    <ULink
                        v-if="socialMediaUrls?.facebook"
                        :to="socialMediaUrls.facebook"
                        target="_blank"
                        aria-label="Facebook"
                        class="text-foreground/80 transition-colors hover:text-primary"
                    >
                        <UIcon name="i-cib-facebook" class="h-6 w-6" />
                    </ULink>
                    <ULink
                        v-if="socialMediaUrls?.instagram"
                        :to="socialMediaUrls.instagram"
                        target="_blank"
                        aria-label="Instagram"
                        class="text-foreground/80 transition-colors hover:text-primary"
                    >
                        <UIcon name="i-cib-instagram" class="h-6 w-6" />
                    </ULink>
                    <ULink
                        v-if="socialMediaUrls?.tiktok"
                        :to="socialMediaUrls.tiktok"
                        target="_blank"
                        aria-label="TikTok"
                        class="text-foreground/80 transition-colors hover:text-primary"
                    >
                        <UIcon name="i-cib-tiktok" class="h-6 w-6" />
                    </ULink>
                    <ULink
                        v-if="socialMediaUrls?.youtube"
                        :to="socialMediaUrls.youtube"
                        target="_blank"
                        aria-label="YouTube"
                        class="text-foreground/80 transition-colors hover:text-primary"
                    >
                        <UIcon name="i-cib-youtube" class="h-6 w-6" />
                    </ULink>
                </div>
                <div class="mt-6 flex gap-4">
                    <UButton color="primary" size="lg" class="px-8" @click="scrollToVideo">Ver Reencuentro</UButton>
                    <UButton color="primary" size="lg" variant="outline" class="px-8" to="#">Conocer más</UButton>
                </div>
            </div>
            <!-- Columna derecha: Carrusel vertical -->
            <GalleryVerticalCarousel class="hidden h-full max-h-full flex-1 md:flex" />
        </UContainer>
    </section>
</template>

<style scoped>
.slide-vertical-enter-active,
.slide-vertical-leave-active {
    transition:
        opacity 0.7s,
        transform 0.7s;
}
.slide-vertical-enter-from {
    opacity: 0;
    transform: translateY(40px);
}
.slide-vertical-leave-to {
    opacity: 0;
    transform: translateY(-40px);
}
</style>
