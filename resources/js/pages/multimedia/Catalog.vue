<script setup lang="ts">
import { formatDate, getYoutubeEmbedUrl } from '@/lib/utils';
import type { Media } from '@/types';
import { router } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

interface Props {
    medias: {
        data: Media[];
        current_page: number;
        last_page: number;
        per_page: number;
        total: number;
    };
    types: string[];
    selectedType: string;
    typeCounts: Record<string, number>;
}

const props = defineProps<Props>();

console.log('multimedias: ', props.medias);

// Estado para la media seleccionada
const selectedMedia = ref<Media | null>(null);

// Computed para el tipo seleccionado
const currentType = computed(() => props.selectedType);

// Función para cambiar de tab
const changeTab = (type: string | number) => {
    if (typeof type === 'string') {
        router.get(
            '/multimedia',
            { tab: type },
            {
                preserveState: true,
                preserveScroll: true,
            },
        );
    }
};

// Función para seleccionar una media
const selectMedia = (media: Media) => {
    selectedMedia.value = media;
};

// Función para obtener el icono según el tipo
const getTypeIcon = (type: string) => {
    const icons = {
        television: 'i-lucide-tv',
        short_video: 'i-lucide-video',
        radio: 'i-lucide-radio',
        podcast: 'i-lucide-headphones',
        audiobook: 'i-lucide-book-open',
    };
    return icons[type as keyof typeof icons] || 'i-lucide-file-video';
};

// Función para formatear el tipo para mostrar
const formatTypeName = (type: string) => {
    const names = {
        television: 'Televisión',
        short_video: 'Videos Cortos',
        radio: 'Radio',
        podcast: 'Podcast',
        audiobook: 'Audiolibros',
    };
    return names[type as keyof typeof names] || type;
};
</script>

<template>
    <div class="min-h-screen bg-background">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <!-- Tabs de navegación -->
            <div class="mb-8">
                <UTabs
                    :items="
                        types.map((type) => ({
                            label: formatTypeName(type),
                            icon: getTypeIcon(type),
                            value: type,
                        }))
                    "
                    :default-value="currentType"
                    @update:model-value="changeTab"
                    class="w-full"
                    size="lg"
                    color="primary"
                    variant="pill"
                />
            </div>

            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                <!-- Sección principal - Media seleccionada (lado izquierdo) -->
                <div class="lg:col-span-2">
                    <UCard class="h-fit">
                        <template #header>
                            <div class="flex items-center gap-2">
                                <UIcon name="i-lucide-play" class="h-5 w-5 text-primary" />
                                <h3 class="font-semibold text-foreground">Reproductor</h3>
                            </div>
                        </template>
                        <div class="p-6">
                            <div v-if="selectedMedia" class="space-y-4">
                                <div class="aspect-video overflow-hidden rounded-lg bg-muted">
                                    <template v-if="currentType === 'television' && selectedMedia.file_url">
                                        <iframe
                                            :src="getYoutubeEmbedUrl(selectedMedia.file_url)"
                                            frameborder="0"
                                            allowfullscreen
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            class="h-full w-full rounded-lg"
                                            title="Reproductor de video de YouTube"
                                        ></iframe>
                                    </template>
                                    <template v-else>
                                        <img :src="selectedMedia.cover_image_url" :alt="selectedMedia.title" class="h-full w-full object-cover" />
                                    </template>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-foreground">{{ selectedMedia.title }}</h4>
                                    <p class="mt-2 text-sm text-muted-foreground">
                                        {{ selectedMedia.description }}
                                    </p>
                                    <div class="mt-3 flex items-center gap-4 text-xs text-muted-foreground">
                                        <span>{{ formatDate(selectedMedia.publication_date) }}</span>
                                        <UBadge
                                            v-if="selectedMedia.category"
                                            :value="selectedMedia.category.name"
                                            color="primary"
                                            variant="soft"
                                            size="xs"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div v-else class="flex flex-col items-center justify-center py-12 text-center">
                                <UIcon name="i-lucide-play-circle" class="h-16 w-16 text-muted-foreground/50" />
                                <p class="mt-4 text-muted-foreground">Selecciona un elemento para reproducir</p>
                            </div>
                        </div>
                    </UCard>
                </div>

                <!-- Lista de medias (lado derecho) -->
                <div class="lg:col-span-1">
                    <div class="mb-6 flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-foreground">
                            {{ formatTypeName(currentType) }}
                        </h2>
                        <p class="text-sm text-muted-foreground">{{ medias.total }} elementos</p>
                    </div>

                    <!-- Lista de medias -->
                    <div class="space-y-4">
                        <UCard
                            v-for="media in medias.data"
                            :key="media.id"
                            class="group cursor-pointer transition-all duration-200 hover:shadow-lg"
                            @click="selectMedia(media)"
                        >
                            <div class="flex gap-4">
                                <div class="relative aspect-video w-24 flex-shrink-0 overflow-hidden rounded-lg">
                                    <img
                                        :src="media.cover_image_url"
                                        :alt="media.title"
                                        class="h-full w-full object-cover transition-transform duration-200 group-hover:scale-105"
                                    />
                                    <div class="absolute inset-0 bg-black/20 opacity-0 transition-opacity duration-200 group-hover:opacity-100" />
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h3 class="line-clamp-2 text-sm font-semibold text-foreground">{{ media.title }}</h3>
                                    <p class="mt-1 line-clamp-2 text-xs text-muted-foreground">
                                        {{ media.description }}
                                    </p>
                                    <div class="mt-2 flex items-center justify-between">
                                        <span class="text-xs text-muted-foreground">{{ formatDate(media.publication_date) }}</span>
                                        <UBadge v-if="media.category" :value="media.category.name" color="primary" variant="soft" size="xs" />
                                    </div>
                                </div>
                            </div>
                        </UCard>
                    </div>

                    <!-- Paginación -->
                    <div v-if="medias.last_page > 1" class="mt-8 flex justify-center">
                        <UPagination
                            :total="medias.total"
                            :per-page="medias.per_page"
                            :current-page="medias.current_page"
                            @update:current-page="(page: number) => router.get('/multimedia', { tab: currentType, page })"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
