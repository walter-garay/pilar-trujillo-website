<script setup lang="ts">
import type { Sponsor } from '@/types';

interface Props {
    sponsors: Sponsor[];
}

const props = defineProps<Props>();
</script>

<template>
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        <UCard v-for="sponsor in props.sponsors" :key="sponsor.id" class="flex flex-col">
            <div class="mb-4 flex items-center gap-4">
                <img v-if="sponsor.logo_url" :src="sponsor.logo_url" :alt="sponsor.name" class="h-16 w-16 rounded-full border object-cover" />
                <div>
                    <h2 class="text-lg font-bold">{{ sponsor.name }}</h2>
                    <p class="text-xs text-muted-foreground">{{ sponsor.email }}</p>
                </div>
            </div>
            <p class="mb-2 text-sm text-muted-foreground">{{ sponsor.description }}</p>
            <div class="mb-2"><span class="font-semibold">Teléfono:</span> {{ sponsor.phone }}</div>
            <div class="mb-2">
                <span class="font-semibold">URL:</span>
                <a :href="sponsor.media_url" class="text-primary underline" target="_blank">{{ sponsor.media_url }}</a>
            </div>
            <div class="mb-2">
                <span class="font-semibold">Promoción:</span>
                <span v-if="sponsor.promotion_start">{{ new Date(sponsor.promotion_start).toLocaleString() }}</span>
                <span v-else>-</span>
                &nbsp;—&nbsp;
                <span v-if="sponsor.promotion_end">{{ new Date(sponsor.promotion_end).toLocaleString() }}</span>
                <span v-else>-</span>
            </div>
            <div v-if="sponsor.social_media_urls" class="mt-2 flex gap-2">
                <span v-for="(url, key) in JSON.parse(sponsor.social_media_urls)" :key="key">
                    <a :href="url" class="text-xs text-blue-500 underline" target="_blank">{{ key }}</a>
                </span>
            </div>
        </UCard>
    </div>
</template>
