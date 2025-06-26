<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import type { Category, Publication } from '@/types';
import { Head } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import PublicationList from './components/PublicationList.vue';
import PublicationModal from './components/PublicationModal.vue';

interface Props {
    publications: Publication[];
    categories: Category[];
    users: any[];
}

const props = defineProps<Props>();

// Search publications
const search = ref('');
const filteredPublications = computed(() => {
    if (!search.value) return props.publications;
    return props.publications.filter((p) => p.title.toLowerCase().includes(search.value.toLowerCase()));
});

const showModal = ref(false);
const editingPublication = ref<Publication | null>(null);

const handleAddPublication = () => {
    editingPublication.value = null;
    showModal.value = true;
};

const handleEdit = (publication: Publication) => {
    editingPublication.value = {
        ...publication,
        author: publication.author ?? undefined,
        category: publication.category ? { ...publication.category, type: publication.category.type ?? 'publication' } : undefined,
        author_id: publication.author?.id ?? publication.author_id,
        category_id: publication.category?.id ?? publication.category_id,
        views_count: publication.views_count ?? 0,
    };
    showModal.value = true;
};
</script>

<template>
    <Head title="Administrar Publicaciones" />
    <AppLayout>
        <div class="p-6">
            <h1 class="mb-6 text-2xl font-bold">Mis publicaciones</h1>
            <div class="mb-6 flex items-center gap-4">
                <UInput v-model="search" placeholder="Buscar publicación" class="w-full max-w-xs" />
                <UButton color="primary" @click="handleAddPublication">Agregar publicación</UButton>
            </div>
            <PublicationList :publications="filteredPublications" @edit="handleEdit" :categories="props.categories" />
            <PublicationModal
                :publication="editingPublication"
                :open="showModal"
                :categories="props.categories"
                :users="props.users"
                @update:open="showModal = $event"
            />
        </div>
    </AppLayout>
</template>
