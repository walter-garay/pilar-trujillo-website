<script setup lang="ts">
import { formatDate, getYoutubeEmbedUrl } from '@/lib/utils';
import type { Media } from '@/types';

interface Props {
    media: Media | null;
    currentType: string;
}

defineProps<Props>();
</script>

<template>
    <UCard class="h-fit">
        <template #header>
            <div class="flex items-center gap-2">
                <UIcon name="i-lucide-play" class="h-5 w-5 text-primary" />
                <h3 class="font-semibold text-foreground">Reproductor</h3>
            </div>
        </template>
        <div class="p-6">
            <div v-if="media" class="space-y-4">
                <div class="aspect-video overflow-hidden rounded-lg bg-muted">
                    <template v-if="currentType === 'television' && media.file_url">
                        <iframe
                            :src="getYoutubeEmbedUrl(media.file_url)"
                            frameborder="0"
                            allowfullscreen
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            class="h-full w-full rounded-lg"
                            title="Reproductor de video de YouTube"
                        ></iframe>
                    </template>
                    <template v-else>
                        <img :src="media.cover_image_url" :alt="media.title" class="h-full w-full object-cover" />
                    </template>
                </div>
                <div>
                    <h4 class="font-semibold text-foreground">{{ media.title }}</h4>
                    <p class="mt-2 text-sm text-muted-foreground">
                        {{ media.description }}
                    </p>
                    <div class="mt-3 flex items-center gap-4 text-xs text-muted-foreground">
                        <span>{{ formatDate(media.publication_date) }}</span>
                        <UBadge v-if="media.category" :value="media.category.name" color="primary" variant="soft" size="xs" />
                    </div>
                </div>
            </div>
            <div v-else class="flex flex-col items-center justify-center py-12 text-center">
                <UIcon name="i-lucide-play-circle" class="h-16 w-16 text-muted-foreground/50" />
                <p class="mt-4 text-muted-foreground">Selecciona un elemento para reproducir</p>
            </div>
        </div>
    </UCard>
</template>
