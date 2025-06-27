<script setup lang="ts">
import Navbar from '@/pages/landing/components/Navbar.vue';
import Footer from '@/pages/landing/sections/Footer.vue';
import type { Publication } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import { computed } from 'vue';

interface Props {
    publication: Publication;
}

const props = defineProps<Props>();

const images = computed(() => props.publication.images || []);
const author = computed(() => props.publication.author);
const category = computed(() => props.publication.category);
const references = computed(() => {
    try {
        return typeof props.publication.references === 'string' ? JSON.parse(props.publication.references) : props.publication.references;
    } catch {
        return {};
    }
});
const tags = computed(() => {
    try {
        return typeof props.publication.tags === 'string' ? JSON.parse(props.publication.tags) : props.publication.tags;
    } catch {
        return [];
    }
});
const formatDate = (dateString: string) => {
    return new Date(dateString).toLocaleDateString('es-ES', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    });
};

const goBack = () => {
    router.visit('/publicaciones');
};
</script>

<template>
    <Head :title="props.publication.title" />
    <div class="min-h-screen bg-muted/30">
        <Navbar />
        <div class="container mx-auto max-w-3xl px-4 py-8 pt-24">
            <!-- Botón volver -->
            <div class="mb-6">
                <UButton color="primary" variant="soft" icon="i-lucide-arrow-left" @click="goBack"> Volver a publicaciones </UButton>
            </div>
            <!-- Carrusel de imágenes -->
            <div v-if="images.length" class="mb-6">
                <UCarousel v-slot="{ item }" :items="images" class="overflow-hidden rounded-lg" :ui="{ container: 'h-[340px]' }">
                    <img :src="item.file_url" :alt="item.caption || 'Imagen de la publicación'" class="h-[340px] w-full object-cover" />
                    <div v-if="item.caption" class="absolute bottom-0 left-0 w-full bg-black/60 px-3 py-1 text-xs text-white">{{ item.caption }}</div>
                </UCarousel>
            </div>

            <!-- Fecha y vistas -->
            <div class="mb-4 flex items-center justify-between text-xs text-muted-foreground">
                <div class="flex items-center gap-2">
                    <UIcon name="i-lucide-calendar" class="h-4 w-4" />
                    <span>{{ formatDate(props.publication.created_at) }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <UIcon name="i-lucide-eye" class="h-4 w-4" />
                    <span>{{ props.publication.views_count }} vista{{ props.publication.views_count !== 1 ? 's' : '' }}</span>
                </div>
            </div>

            <!-- Categoría -->
            <div v-if="category" class="mb-4">
                <UBadge color="primary" variant="soft">{{ category.name }}</UBadge>
            </div>

            <!-- Autor -->
            <div class="mb-6 flex items-center gap-4 rounded-lg bg-card p-4 shadow-sm">
                <UAvatar
                    :src="
                        author?.photo_url || 'https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png?20150327203541'
                    "
                    :alt="author?.name"
                    size="lg"
                    class="border border-border"
                />
                <div>
                    <div class="font-semibold text-card-foreground">{{ author?.name }}</div>
                    <div class="text-xs text-muted-foreground">Autor</div>
                </div>
            </div>

            <!-- Fuente -->
            <div v-if="references?.name || references?.url" class="mb-6">
                <div class="flex items-center gap-2 text-sm">
                    <UIcon name="i-lucide-link" class="h-4 w-4 text-primary" />
                    <span class="font-medium text-muted-foreground">Publicado en:</span>
                    <a v-if="references?.url" :href="references.url" target="_blank" class="text-primary underline hover:text-primary/80">{{
                        references.name || references.url
                    }}</a>
                    <span v-else class="text-muted-foreground">{{ references.name }}</span>
                </div>
            </div>

            <!-- Contenido -->
            <div class="prose prose-lg mb-8 max-w-none text-card-foreground">
                <div v-html="props.publication.content" />
            </div>

            <!-- Tags -->
            <div v-if="tags.length" class="mt-4 flex flex-wrap gap-2">
                <UBadge v-for="tag in tags" :key="tag" color="secondary" variant="soft">#{{ tag }}</UBadge>
            </div>
        </div>
        <Footer />
    </div>
</template>
