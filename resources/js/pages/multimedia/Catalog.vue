<script setup lang="ts">
import type { Media } from '@/types';
import { computed, ref } from 'vue';
import MediaList from './components/MediaList.vue';
import MediaTabs from './components/MediaTabs.vue';
import MediaViewer from './components/MediaViewer.vue';

interface Props {
    medias: {
        data: Media[];
        current_page: number;
        last_page: number;
        per_page: number;
        total: number;
    };
    selectedType: string;
}

const props = defineProps<Props>();

// Estado para la media seleccionada
const selectedMedia = ref<Media | null>(null);

// Computed para el tipo seleccionado
const currentType = computed(() => props.selectedType);

// Función para seleccionar una media
const handleMediaSelect = (media: Media) => {
    selectedMedia.value = media;
};
</script>

<template>
    <div class="min-h-screen bg-background">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <!-- Tabs de navegación -->
            <MediaTabs :selected-type="currentType" />

            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                <!-- Sección principal - Media seleccionada (lado izquierdo) -->
                <div class="lg:col-span-2">
                    <MediaViewer :media="selectedMedia" :current-type="currentType" />
                </div>

                <!-- Lista de medias (lado derecho) -->
                <div class="lg:col-span-1">
                    <MediaList :medias="medias" :current-type="currentType" :selected-media="selectedMedia" @select-media="handleMediaSelect" />
                </div>
            </div>
        </div>
    </div>
</template>
