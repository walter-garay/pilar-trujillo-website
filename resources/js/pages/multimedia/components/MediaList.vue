<script setup lang="ts">
import { formatDate } from '@/lib/utils';
import type { Media } from '@/types';
import { computed, ref, watch } from 'vue';

interface Props {
    medias: Media[];
    currentType: string;
    selectedMedia: Media | null;
    selectedMediaId: number | null;
}

const props = defineProps<Props>();
console.log('medialist:', props.medias);

const emit = defineEmits<{
    selectMedia: [media: Media];
}>();

const PAGE_SIZE = 2; // Puedes ajustar el tamaño de página aquí
const currentPage = ref(1);

// Calcular la página de la media seleccionada al cargar
watch(
    [() => props.medias, () => props.selectedMediaId],
    ([mediaList, selectedId]) => {
        if (selectedId) {
            const idx = mediaList.findIndex((m: Media) => m.id === selectedId);
            if (idx !== -1) {
                currentPage.value = Math.floor(idx / PAGE_SIZE) + 1;
            } else {
                currentPage.value = 1;
            }
        } else {
            currentPage.value = 1;
        }
    },
    { immediate: true },
);

const pagedMedias = computed(() => {
    const start = (currentPage.value - 1) * PAGE_SIZE;
    return props.medias.slice(start, start + PAGE_SIZE);
});

const totalPages = computed(() => {
    return Math.ceil(props.medias.length / PAGE_SIZE) || 1;
});


const handleMediaSelect = (media: Media) => {
    emit('selectMedia', media);
};

// Función para formatear el tipo para mostrar
const formatTypeName = (type: string) => {
    const names = {
        television: 'Televisión',
        short_video: 'Videos Cortos',
        radio: 'Radio',
        podcast: 'Podcast',
        audiobook: 'Audiolibros',
        exclusive: 'Exclusivos',
    };
    return names[type as keyof typeof names] || type;
};
</script>

<template>
    <div>
        <div class="mb-6 flex items-center justify-between">
            <h2 class="text-xl font-semibold text-foreground">
                {{ formatTypeName(currentType) }}
            </h2>
            <p class="text-sm text-muted-foreground">{{ medias.length }} elementos</p>
        </div>

        <!-- Lista de medias -->
        <div class="space-y-4">
            <UCard
                v-for="media in pagedMedias"
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
                        <div class="mt-2 flex items-center gap-4 text-xs text-muted-foreground">
                            <span class="flex items-center gap-1.5">
                                <UIcon name="i-lucide-eye" class="h-4 w-4" />
                                {{ media.views_count?.toLocaleString() }}
                            </span>
                            <span class="flex items-center gap-1.5">
                                <UIcon name="i-lucide-thumbs-up" class="h-4 w-4" />
                                {{ media.likes_count?.toLocaleString() }}
                            </span>
                        </div>
                    </div>
                </div>
            </UCard>
        </div>
        <div v-if="totalPages > 1" class="mt-8 flex justify-center">
            <UPagination
                v-model:page="currentPage"
                :total="medias.length"
                :items-per-page="PAGE_SIZE"
                :show-controls="true"
            />
        </div>
    </div>
</template>
