<script setup lang="ts">
import { Dialog, DialogContent, DialogDescription, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import { formatDate, getYoutubeEmbedUrl } from '@/lib/utils';
import type { Media } from '@/types';
import { computed } from 'vue';

const props = defineProps({
    modelValue: {
        type: Boolean,
        required: true,
    },
    media: {
        type: Object as () => Media | null,
        required: true,
    },
});

const emit = defineEmits(['update:modelValue']);

const isOpen = computed({
    get: () => props.modelValue,
    set: (value) => emit('update:modelValue', value),
});

const videoUrl = computed(() => {
    if (!props.media?.file_url) return '';
    return getYoutubeEmbedUrl(props.media.file_url) + '?autoplay=1&rel=0';
});
</script>

<template>
    <Dialog v-model:open="isOpen">
        <DialogContent class="max-w-3xl">
            <DialogHeader>
                <DialogTitle>{{ media?.title }}</DialogTitle>
                <div class="flex items-center gap-4 pt-2 text-sm text-muted-foreground">
                    <span v-if="media?.category" class="font-semibold">{{ media.category.name }}</span>
                    <span v-if="media?.category && media?.publication_date">|</span>
                    <span v-if="media?.publication_date">{{ formatDate(media.publication_date) }}</span>
                </div>
                <div class="mt-2 flex items-center gap-4 text-xs text-muted-foreground">
                    <span v-if="media?.views_count" class="flex items-center gap-1.5">
                        <UIcon name="i-lucide-eye" class="h-4 w-4" />
                        {{ media.views_count.toLocaleString() }}
                    </span>
                    <span v-if="media?.likes_count" class="flex items-center gap-1.5">
                        <UIcon name="i-lucide-thumbs-up" class="h-4 w-4" />
                        {{ media.likes_count.toLocaleString() }}
                    </span>
                </div>
            </DialogHeader>
            <div class="aspect-video py-4">
                <iframe
                    v-if="videoUrl"
                    :src="videoUrl"
                    frameborder="0"
                    allowfullscreen
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    class="h-full w-full rounded-lg"
                    title="Reproductor de video de YouTube"
                ></iframe>
            </div>
            <DialogDescription class="mt-4 text-base">
                {{ media?.description }}
            </DialogDescription>
        </DialogContent>
    </Dialog>
</template>
