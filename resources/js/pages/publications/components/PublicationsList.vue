<script setup lang="ts">
import type { Publication } from '@/types';
import { router } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

interface Props {
    publications: Publication[];
}

const props = defineProps<Props>();

// Estado para filtros
const selectedCategory = ref<string>('all');
const searchQuery = ref('');

// Filtrar publicaciones
const filteredPublications = computed(() => {
    let filtered = props.publications;

    // Filtrar por categoría
    if (selectedCategory.value !== 'all') {
        filtered = filtered.filter((pub) => pub.category?.id.toString() === selectedCategory.value);
    }

    // Filtrar por búsqueda
    if (searchQuery.value) {
        const query = searchQuery.value.toLowerCase();
        filtered = filtered.filter(
            (pub) =>
                pub.title.toLowerCase().includes(query) ||
                pub.content?.toLowerCase().includes(query) ||
                pub.author?.name.toLowerCase().includes(query),
        );
    }

    return filtered;
});

// Obtener categorías únicas
const categories = computed(() => {
    const categoryMap = new Map();
    props.publications.forEach((pub) => {
        if (pub.category) {
            categoryMap.set(pub.category.id, pub.category);
        }
    });
    return Array.from(categoryMap.values());
});

const formatDate = (dateString: string) => {
    return new Date(dateString).toLocaleDateString('es-ES', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    });
};

const goToPublication = (id: number) => {
    router.visit(`/publicaciones/${id}`);
};
</script>

<template>
    <div class="space-y-6">
        <!-- Filtros -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex flex-1 gap-2">
                <UInput v-model="searchQuery" placeholder="Buscar publicaciones..." icon="i-lucide-search" class="max-w-xs" />
                <USelect
                    v-model="selectedCategory"
                    :items="[
                        { label: 'Todas las categorías', value: 'all' },
                        ...categories.map((cat) => ({ label: cat.name, value: cat.id.toString() })),
                    ]"
                    class="w-48"
                />
            </div>
            <div class="text-sm text-muted-foreground">
                {{ filteredPublications.length }} publicación{{ filteredPublications.length !== 1 ? 'es' : '' }} encontrada{{
                    filteredPublications.length !== 1 ? 's' : ''
                }}
            </div>
        </div>

        <!-- Lista de publicaciones -->
        <div v-if="filteredPublications.length > 0" class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <UCard
                v-for="publication in filteredPublications"
                :key="publication.id"
                class="group relative cursor-pointer transition-shadow duration-200 hover:shadow-lg"
                @click="goToPublication(publication.id)"
            >
                <!-- Imagen de la publicación -->
                <div v-if="publication.images && publication.images.length" class="mb-2">
                    <img :src="publication.images[0].file_url" :alt="publication.title" class="h-40 w-full rounded object-cover" />
                </div>
                <!-- Badge de categoría en esquina superior derecha -->
                <div v-if="publication.category" class="absolute top-3 right-3 z-10">
                    <UBadge :color="publication.category.id % 2 === 0 ? 'primary' : 'secondary'" variant="soft" size="sm">
                        {{ publication.category.name }}
                    </UBadge>
                </div>

                <template #header>
                    <div class="space-y-2 pr-16">
                        <h3 class="line-clamp-2 text-lg font-semibold transition-colors group-hover:text-primary">
                            {{ publication.title }}
                        </h3>
                        <div class="flex items-center gap-2 text-sm text-muted-foreground">
                            <span v-if="publication.author">{{ publication.author.name }}</span>
                        </div>
                    </div>
                </template>

                <div class="space-y-3">
                    <!-- Fuente -->
                    <div v-if="publication.references" class="text-xs text-muted-foreground">
                        <span v-if="JSON.parse(publication.references).name"> Publicado en: {{ JSON.parse(publication.references).name }} </span>
                    </div>

                    <!-- Estadísticas -->
                    <div class="flex items-center justify-between text-xs text-muted-foreground">
                        <span>{{ formatDate(publication.created_at) }}</span>
                        <span v-if="publication.views_count">{{ publication.views_count }} vista{{ publication.views_count !== 1 ? 's' : '' }}</span>
                    </div>
                </div>

                <template #footer>
                    <div class="flex justify-end">
                        <UButton color="primary" variant="link" size="sm" @click.stop="goToPublication(publication.id)"> Leer</UButton>
                    </div>
                </template>
            </UCard>
        </div>

        <!-- Estado vacío -->
        <div v-else class="py-12 text-center">
            <div class="space-y-4">
                <UIcon name="i-lucide-file-text" class="mx-auto h-12 w-12 text-muted-foreground" />
                <div>
                    <h3 class="text-lg font-medium">No se encontraron publicaciones</h3>
                    <p class="text-sm text-muted-foreground">
                        {{
                            searchQuery || selectedCategory !== 'all'
                                ? 'Intenta ajustar los filtros de búsqueda.'
                                : 'No hay publicaciones disponibles en este momento.'
                        }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
