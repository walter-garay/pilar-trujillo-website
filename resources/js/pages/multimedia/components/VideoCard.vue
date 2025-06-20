<script setup lang="ts">
// No es necesario definir 'props' como variable, solo defineProps y usa las props directamente
const props = defineProps({
    youtubeId: String,
    type: String,
    duration: String,
    title: String,
    description: String,
});
</script>

<template>
    <UCard class="max-w-xs overflow-hidden rounded-2xl bg-white p-0 shadow-md">
        <div class="relative">
            <iframe
                v-if="props.youtubeId"
                :src="`https://www.youtube.com/embed/${props.youtubeId}`"
                frameborder="0"
                allowfullscreen
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                class="m-0 h-40 w-full p-0"
                loading="lazy"
                title="Previsualización de video de YouTube"
            ></iframe>
            <div class="absolute top-3 left-3 flex gap-2">
                <UBadge color="primary" variant="soft" size="sm">{{ props.type }}</UBadge>
            </div>
            <div class="absolute top-3 right-3">
                <UBadge color="neutral" variant="soft" size="sm">{{ props.duration }}</UBadge>
            </div>
        </div>
        <div class="p-3">
            <h4 class="mb-1 text-lg font-bold">{{ props.title }}</h4>
            <p class="mb-1 text-sm text-gray-500">{{ props.description }}</p>
        </div>
    </UCard>
</template>
