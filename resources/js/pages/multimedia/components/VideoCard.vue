<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps({
    fileUrl: { type: String, required: true },
    coverImageUrl: String,
    type: String, // category name
    title: String,
    description: String,
});

const youtubeId = computed(() => {
    if (!props.fileUrl || !props.fileUrl.includes('youtube.com/watch')) return null;
    try {
        return new URL(props.fileUrl).searchParams.get('v');
    } catch {
        console.error('Invalid URL for YouTube video:', props.fileUrl);
        return null;
    }
});

const thumbnailUrl = computed(() => {
    if (props.coverImageUrl) {
        return props.coverImageUrl;
    }
    if (youtubeId.value) {
        return `https://img.youtube.com/vi/${youtubeId.value}/hqdefault.jpg`;
    }
    // Fallback image if no cover and not a youtube video
    return `https://ui-avatars.com/api/?name=${encodeURIComponent(props.title || 'P')}&size=400&background=random`;
});
</script>

<template>
    <UCard
        class="group max-w-xs cursor-pointer overflow-hidden rounded-lg bg-card shadow-sm transition-transform duration-300 ease-in-out hover:scale-102" variant="soft"
    >
        <div class="relative">
            <img :src="thumbnailUrl" :alt="props.title" class="m-0 h-40 w-full object-cover p-0" loading="lazy" />
            <div
                class="absolute inset-0 flex items-center justify-center bg-black/40 opacity-0 transition-opacity duration-300 group-hover:opacity-100"
            >
                <UIcon name="i-lucide-play-circle" class="h-16 w-16 text-white" />
            </div>
            <div class="absolute top-3 left-3 flex gap-2">
                <UBadge color="neutral" variant="solid" size="sm">{{ props.type }}</UBadge>
            </div>
        </div>
        <div class="p-3">
            <h4 class="mb-1 text-lg font-bold text-foreground">{{ props.title }}</h4>
            <p class="mb-1 text-sm text-muted-foreground">{{ props.description }}</p>
        </div>
    </UCard>
</template>
