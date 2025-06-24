<script setup lang="ts">
import { formatDate } from '@/lib/utils';
import type { Media } from '@/types';
import { router } from '@inertiajs/vue3';

interface Props {
    medias: {
        data: Media[];
        current_page: number;
        last_page: number;
        per_page: number;
        total: number;
    };
    currentType: string;
    selectedMedia: Media | null;
}

const props = defineProps<Props>();

const emit = defineEmits<{
    selectMedia: [media: Media];
}>();

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

const handleMediaSelect = (media: Media) => {
    emit('selectMedia', media);
};

const handlePageChange = (page: number) => {
    router.get('/multimedia', { tab: props.currentType, page });
};
</script>

<template>
    <div>
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
                :class="{ 'ring-2 ring-primary': selectedMedia?.id === media.id }"
                @click="handleMediaSelect(media)"
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
                @update:current-page="handlePageChange"
            />
        </div>
    </div>
</template>
