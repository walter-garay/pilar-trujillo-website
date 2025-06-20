<script setup lang="ts">
import { defineProps } from 'vue';

const props = defineProps({
    image: String,
    type: String,
    duration: String,
    title: String,
    description: String,
    link: String,
});
</script>

<template>
    <UCard class="max-w-[220px] overflow-hidden rounded-2xl bg-white shadow-md">
        <div class="relative">
            <img :src="props.image" alt="" class="h-32 w-full object-cover" />
            <span class="absolute top-2 left-2 rounded-full bg-primary/90 px-2 py-0.5 text-xs font-semibold text-white">{{ props.type }}</span>
            <span class="absolute top-2 right-2 rounded-full bg-white/90 px-2 py-0.5 text-xs font-semibold text-gray-800">{{ props.duration }}</span>
        </div>
        <div class="p-3">
            <h4 class="mb-1 text-base font-bold">{{ props.title }}</h4>
            <p class="mb-2 text-xs text-gray-500">{{ props.description }}</p>
            <NuxtLink :to="props.link" class="flex items-center gap-1 text-sm font-medium text-primary hover:underline">
                Ver más <UIcon name="i-lucide-arrow-right" class="h-4 w-4" />
            </NuxtLink>
        </div>
    </UCard>
</template>
