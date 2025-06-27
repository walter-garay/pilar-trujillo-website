<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import type { Category, Publication } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import PublicationList from './components/PublicationList.vue';

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

const goToCreate = () => {
    router.visit(route('admin.publications.create'));
};
</script>

<template>
    <Head title="Administrar Publicaciones" />
    <AppLayout>
        <div class="p-6">
            <h1 class="mb-6 text-2xl font-bold">Publicaciones</h1>
            <div class="mb-6 flex items-center gap-4">
                <UInput v-model="search" placeholder="Buscar publicación" class="w-full max-w-xs" />
                <UButton color="primary" @click="goToCreate">Agregar publicación</UButton>
            </div>
            <PublicationList :publications="filteredPublications" :categories="props.categories" />
        </div>
    </AppLayout>
</template>
