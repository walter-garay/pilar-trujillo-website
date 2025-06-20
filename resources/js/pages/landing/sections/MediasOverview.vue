<script setup lang="ts">
import VideoCard from '@/pages/multimedia/components/VideoCard.vue';
import type { TabsItem } from '@nuxt/ui';
import { ref } from 'vue';

const items = ref<TabsItem[]>([
    {
        label: 'Televisión',
        icon: 'i-lucide-monitor',
        slot: 'television',
    },
    {
        label: 'Videos Cortos',
        icon: 'i-lucide-film',
        slot: 'videos',
    },
    {
        label: 'Publicaciones',
        icon: 'i-lucide-book-open',
        slot: 'publicaciones',
    },
    {
        label: 'Radio',
        icon: 'i-lucide-radio',
        slot: 'radio',
    },
    {
        label: 'Podcasts',
        icon: 'i-lucide-mic',
        slot: 'podcasts',
    },
    {
        label: 'Audiolibros',
        icon: 'i-lucide-headphones',
        slot: 'audiolibros',
    },
]);

const televisionVideos = [
    {
        youtubeId: 'EgmiczbGo20',
        type: 'Documental',
        duration: '3 x 45 min',
        title: 'Investigación: Corrupción en el sistema de salud',
        description: 'Un documental de 3 partes que expone las irregularidades en los hospitales públicos',
    },
    {
        youtubeId: 'jyfCuEpF3Cs',
        type: 'Entrevista',
        duration: '60 min',
        title: 'Entrevista exclusiva: Presidente del Senado',
        description: 'Una conversación sin filtros sobre las reformas políticas pendientes',
    },
    {
        youtubeId: 'nISIj0VY3pU',
        type: 'Reportaje',
        duration: '38 min',
        title: 'Reportaje especial: Migración infantil',
        description: 'Las historias no contadas de los niños que cruzan fronteras',
    },
];
</script>

<template>
    <section class="mx-auto max-w-5xl px-4 py-12">
        <div class="mb-10 text-center">
            <h2 class="mb-3 text-3xl font-extrabold md:text-4xl">
                <span class="text-foreground">Catálogo</span>
                <span class="text-primary"> Multimedia</span>
            </h2>
            <p class="mx-auto max-w-2xl text-lg text-muted-foreground">
                Explora todo mi contenido organizado por categorías para encontrar exactamente lo que buscas
            </p>
        </div>
        <UTabs :items="items" class="w-full" size="lg" color="primary" variant="pill">
            <template #television>
                <div class="flex flex-col items-center gap-8">
                    <div class="flex w-full flex-col justify-center gap-6 md:flex-row">
                        <VideoCard v-for="(video, i) in televisionVideos" :key="i" v-bind="video" />
                    </div>
                    <ULink
                        to="#"
                        class="animate-bounce-slow mt-4 flex items-center gap-2 rounded-full bg-primary/90 px-8 py-3 font-semibold text-white shadow transition hover:bg-primary focus:ring-2 focus:ring-primary focus:ring-offset-2 focus:outline-none"
                        active-class="bg-primary"
                        aria-label="Cargar más contenido"
                    >
                        <UIcon name="i-lucide-arrow-down-circle" class="h-5 w-5" />
                        Cargar más contenido
                    </ULink>
                </div>
            </template>
            <template #videos>
                <div class="py-8">
                    <h3 class="mb-2 text-xl font-semibold">Videos Cortos</h3>
                    <p class="mb-4 text-muted-foreground">Clips y videos breves para compartir y disfrutar rápidamente.</p>
                </div>
            </template>
            <template #publicaciones>
                <div class="py-8">
                    <h3 class="mb-2 text-xl font-semibold">Publicaciones</h3>
                    <p class="mb-4 text-muted-foreground">Artículos, ensayos y otros textos multimedia.</p>
                </div>
            </template>
            <template #radio>
                <div class="py-8">
                    <h3 class="mb-2 text-xl font-semibold">Radio</h3>
                    <p class="mb-4 text-muted-foreground">Programas y entrevistas transmitidas en radio.</p>
                </div>
            </template>
            <template #podcasts>
                <div class="py-8">
                    <h3 class="mb-2 text-xl font-semibold">Podcasts</h3>
                    <p class="mb-4 text-muted-foreground">Episodios y series de audio bajo demanda.</p>
                </div>
            </template>
            <template #audiolibros>
                <div class="py-8">
                    <h3 class="mb-2 text-xl font-semibold">Audiolibros</h3>
                    <p class="mb-4 text-muted-foreground">Libros narrados para escuchar en cualquier momento.</p>
                </div>
            </template>
        </UTabs>
    </section>
</template>
