<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps({
    fileUrl: { type: String, required: true },
    coverImageUrl: String,
    type: String, // category name
    title: String,
    description: String,
    viewsCount: Number,
    likesCount: Number,
});

const thumbnailUrl = computed(() => {
    if (props.coverImageUrl) {
        return props.coverImageUrl;
    }
    // Fallback image if no cover
    return `https://ui-avatars.com/api/?name=${encodeURIComponent(props.title || 'P')}&size=400&background=random`;
});
</script>

<template>
    <UCard
        class="group max-w-xs cursor-pointer overflow-hidden rounded-lg bg-card shadow-sm transition-transform duration-300 ease-in-out hover:scale-102"
        variant="soft"
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
            <p class="mb-1 line-clamp-2 text-sm text-muted-foreground">{{ props.description }}</p>
            <div class="mt-2 flex items-center justify-between text-xs text-muted-foreground">
                <span class="flex items-center gap-1">
                    <UIcon name="i-lucide-eye" class="h-4 w-4" />
                    {{ props.viewsCount?.toLocaleString() ?? 0 }}
                </span>
                <span class="flex items-center gap-1">
                    <UIcon name="i-lucide-thumbs-up" class="h-4 w-4" />
                    {{ props.likesCount?.toLocaleString() ?? 0 }}
                </span>
            </div>
        </div>
    </UCard>
</template>
