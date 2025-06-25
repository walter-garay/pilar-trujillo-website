<script setup lang="ts">
import { useMediaTabs } from '@/composables/useMediaTabs';
import VideoCard from '@/pages/landing/components/VideoCard.vue';
import VideoDialog from '@/pages/landing/components/VideoDialog.vue';
import type { Media } from '@/types';
import { ref } from 'vue';

const props = defineProps({
    medias: Object as () => Record<string, Media[]>,
});

const { itemsWithSlot: items } = useMediaTabs();

const selectedVideo = ref<Media | null>(null);
const isModalOpen = ref(false);

function openVideoModal(video: Media) {
    selectedVideo.value = video;
    isModalOpen.value = true;
}
</script>

<template>
    <section class="bg-background py-20">
        <div class="mx-auto max-w-5xl px-4">
            <div class="mb-10 text-center">
                <h2 class="mb-3 text-3xl font-extrabold md:text-4xl">
                    <span class="text-foreground">Catálogo</span>
                    <span class="text-primary"> Multimedia</span>
                </h2>
                <p class="mx-auto max-w-2xl text-lg text-muted-foreground">
                    Explora todo mi contenido organizado por categorías para encontrar exactamente lo que buscas
                </p>
            </div>
            <UTabs :items="items" class="w-full space-y-8" size="lg" color="primary" variant="pill">
                <template #television>
                    <div class="flex flex-col items-center gap-8">
                        <div class="grid w-full grid-cols-1 justify-center gap-6 md:grid-cols-2 lg:grid-cols-3">
                            <VideoCard
                                v-for="video in props.medias?.television"
                                :key="video.id"
                                :file-url="video.file_url"
                                :cover-image-url="video.cover_image_url"
                                :title="video.title"
                                :description="video.description"
                                :type="video.category?.name"
                                :views-count="video.views_count"
                                :likes-count="video.likes_count"
                                @click="openVideoModal(video)"
                            />
                        </div>
                    </div>
                </template>
                <template #short_video>
                    <div class="py-8">
                        <h3 class="mb-2 text-xl font-semibold">Videos Cortos</h3>
                        <p class="mb-4 text-muted-foreground">Clips y videos breves para compartir y disfrutar rápidamente.</p>
                    </div>
                </template>
                <template #radio>
                    <div class="py-8">
                        <h3 class="mb-2 text-xl font-semibold">Radio</h3>
                        <p class="mb-4 text-muted-foreground">Programas y entrevistas transmitidas en radio.</p>
                    </div>
                </template>
                <template #podcast>
                    <div class="py-8">
                        <h3 class="mb-2 text-xl font-semibold">Podcasts</h3>
                        <p class="mb-4 text-muted-foreground">Episodios y series de audio bajo demanda.</p>
                    </div>
                </template>
                <template #audiobook>
                    <div class="py-8">
                        <h3 class="mb-2 text-xl font-semibold">Audiolibros</h3>
                        <p class="mb-4 text-muted-foreground">Libros narrados para escuchar en cualquier momento.</p>
                    </div>
                </template>
            </UTabs>
        </div>
    </section>
    <VideoDialog v-model="isModalOpen" :media="selectedVideo" />
</template>
