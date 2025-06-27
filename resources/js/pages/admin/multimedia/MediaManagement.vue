<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import type { Media } from '@/types';
import { Head } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import MediaList from './components/MediaList.vue';
import MediaModal from './components/MediaModal.vue';

interface Props {
    medias: Media[];
    selectedType: string;
    categories: any[];
}

const props = defineProps<Props>();

const search = ref('');
const showModal = ref(false);
const editingMedia = ref<Media | null>(null);

const typeTitles: Record<string, string> = {
    television: 'Televisión',
    podcast: 'Podcast',
    audiolibros: 'Audiolibros',
    radio: 'Radio',
    exclusivos: 'Videos exclusivos',
    cortos: 'Videos cortos',
    short_video: 'Videos cortos',
    audiobook: 'Audiolibros',
    exclusive: 'Videos exclusivos',
};

const pageTitle = computed(() => typeTitles[props.selectedType] || 'Multimedia');

const filteredMedias = computed(() => {
    if (!search.value) return props.medias.map((m) => ({ ...m, tags: typeof m.tags === 'string' ? JSON.parse(m.tags || '[]') : m.tags || [] }));
    return props.medias
        .filter((m) => m.title.toLowerCase().includes(search.value.toLowerCase()))
        .map((m) => ({ ...m, tags: typeof m.tags === 'string' ? JSON.parse(m.tags || '[]') : m.tags || [] }));
});

const handleAddMedia = () => {
    editingMedia.value = {
        title: '',
        description: '',
        file_url: '',
        cover_image_url: '',
        type: props.selectedType,
        publication_date: '',
        category_id: 1,
        user_id: 1,
        tags: '[]',
        views_count: 0,
        likes_count: 0,
    } as Media;
    showModal.value = true;
};

const handleEdit = (media: Media) => {
    let tags = media.tags;
    if (Array.isArray(tags)) {
        tags = JSON.stringify(tags);
    }
    editingMedia.value = { ...media, tags };
    showModal.value = true;
};
</script>

<template>
    <AppLayout>
        <Head :title="`Administrar ${pageTitle}`" />
        <div class="p-6">
            <h1 class="mb-6 text-2xl font-bold">{{ pageTitle }}</h1>
            <div class="mb-6 flex items-center gap-4">
                <UInput v-model="search" :placeholder="`Buscar ${pageTitle.toLowerCase()}`" class="w-full max-w-xs" />
                <UButton color="primary" @click="handleAddMedia">Agregar contenido</UButton>
            </div>
            <MediaList :medias="filteredMedias" @edit="handleEdit" />
            <MediaModal
                :media="editingMedia"
                :open="showModal"
                :type="props.selectedType"
                :categories="props.categories"
                @update:open="showModal = $event"
            />
        </div>
    </AppLayout>
</template>
