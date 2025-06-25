<script setup lang="ts">
import type { Media } from '@/types';
import { ref, watch } from 'vue';
import MediaList from './components/MediaList.vue';
import MediaTabs from './components/MediaTabs.vue';
import MediaViewer from './components/MediaViewer.vue';

interface Props {
    medias: Media[];
    selectedType: string;
    selectedMediaId: number | null;
}

const props = defineProps<Props>();

console.log('Medias recibidas:', props.medias);

// Estado para la media seleccionada
const selectedMedia = ref<Media | null>(null);

// Cuando cambia la lista de medias o el id seleccionado, actualiza la media seleccionada
watch(
    [() => props.medias, () => props.selectedMediaId],
    ([mediaList, selectedId]) => {
        if (selectedId) {
            const found = mediaList.find((m: Media) => m.id === selectedId);
            selectedMedia.value = found || null;
        } else {
            selectedMedia.value = null;
        }
    },
    { immediate: true },
);

// Función para seleccionar una media visualmente
const handleMediaSelect = (media: Media) => {
    selectedMedia.value = media;
};
</script>

<template>
    <div class="min-h-screen bg-background">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <!-- Tabs de navegación -->
            <MediaTabs :selected-type="props.selectedType" />

            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                <!-- Sección principal - Media seleccionada (lado izquierdo) -->
                <div class="lg:col-span-2">
                    <MediaViewer :media="selectedMedia" :current-type="props.selectedType" />
                </div>

                <!-- Lista de medias (lado derecho) -->
                <div class="lg:col-span-1">
                    <MediaList
                        :medias="props.medias"
                        :current-type="props.selectedType"
                        :selected-media="selectedMedia"
                        :selected-media-id="props.selectedMediaId"
                        @select-media="handleMediaSelect"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
