<script setup lang="ts">
import Navbar from '@/pages/landing/components/Navbar.vue';
import Footer from '@/pages/landing/sections/Footer.vue';
import type { Publication } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

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

// Carrusel manual
const currentIndex = ref(0);
const goPrev = () => {
    if (images.value.length) {
        currentIndex.value = (currentIndex.value - 1 + images.value.length) % images.value.length;
    }
};
const goNext = () => {
    if (images.value.length) {
        currentIndex.value = (currentIndex.value + 1) % images.value.length;
    }
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
            <!-- Título de la publicación -->
            <h1 class="mb-4 text-center text-3xl font-bold text-card-foreground">{{ props.publication.title }}</h1>
            <!-- Carrusel de imágenes con botones laterales -->
            <div v-if="images.length" class="relative mb-6 flex items-center justify-center">
                <button v-if="images.length > 1" class="carousel-btn left" @click="goPrev" aria-label="Anterior">
                    <svg width="32" height="32" fill="none" viewBox="0 0 24 24">
                        <path d="M15 19l-7-7 7-7" stroke="#fcc633" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <div class="carousel-img-wrapper">
                    <img :src="images[currentIndex].file_url" alt="Imagen de la publicación" class="carousel-img" />
                </div>
                <button v-if="images.length > 1" class="carousel-btn right" @click="goNext" aria-label="Siguiente">
                    <svg width="32" height="32" fill="none" viewBox="0 0 24 24">
                        <path d="M9 5l7 7-7 7" stroke="#fcc633" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
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
            <div class="publication-content mb-8 max-w-none text-card-foreground">
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

<style scoped>
.carousel-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0, 0, 0, 0.25);
    border: none;
    border-radius: 50%;
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 10;
    transition: background 0.2s;
}
.carousel-btn.left {
    left: -24px;
}
.carousel-btn.right {
    right: -24px;
}
.carousel-btn:hover {
    background: rgba(252, 198, 51, 0.8);
}
.carousel-img-wrapper {
    position: relative;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 320px;
    max-height: 420px;
    overflow: hidden;
    border-radius: 12px;
    background: #fff;
}
.carousel-img {
    max-width: 100%;
    max-height: 420px;
    width: auto;
    height: auto;
    object-fit: contain;
    display: block;
    margin: 0 auto;
}

/* Estilos para el contenido HTML de Quill */
.publication-content {
    line-height: 1.6;
    color: var(--foreground);
}

.publication-content h1,
.publication-content h2,
.publication-content h3,
.publication-content h4,
.publication-content h5,
.publication-content h6 {
    margin-top: 1.5em;
    margin-bottom: 0.5em;
    font-weight: 600;
    line-height: 1.25;
}

.publication-content h1 {
    font-size: 2em;
}
.publication-content h2 {
    font-size: 1.75em;
}
.publication-content h3 {
    font-size: 1.5em;
}
.publication-content h4 {
    font-size: 1.25em;
}
.publication-content h5 {
    font-size: 1.125em;
}
.publication-content h6 {
    font-size: 1em;
}

.publication-content p {
    margin-bottom: 1em;
    line-height: 1.7;
}

.publication-content ul,
.publication-content ol {
    margin: 1em 0;
    padding-left: 2em;
}

.publication-content li {
    margin-bottom: 0.5em;
}

.publication-content blockquote {
    margin: 1.5em 0;
    padding: 1em 1.5em;
    border-left: 4px solid var(--primary);
    background-color: var(--muted);
    font-style: italic;
    border-radius: 0 8px 8px 0;
}

.publication-content a {
    color: var(--primary);
    text-decoration: underline;
    text-decoration-thickness: 1px;
    text-underline-offset: 2px;
}

.publication-content a:hover {
    color: var(--primary);
    opacity: 0.8;
}

.publication-content strong {
    font-weight: 600;
}

.publication-content em {
    font-style: italic;
}

.publication-content u {
    text-decoration: underline;
}

.publication-content s {
    text-decoration: line-through;
}

.publication-content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 1em 0;
}

.publication-content code {
    background-color: var(--muted);
    padding: 0.2em 0.4em;
    border-radius: 4px;
    font-family: 'Courier New', monospace;
    font-size: 0.9em;
}

.publication-content pre {
    background-color: var(--muted);
    padding: 1em;
    border-radius: 8px;
    overflow-x: auto;
    margin: 1em 0;
}

.publication-content pre code {
    background: none;
    padding: 0;
}
</style>
