<script setup lang="ts">
import { formatDate, getYoutubeEmbedUrl } from '@/lib/utils';
import type { Media } from '@/types';
import axios from 'axios';
import { ref, watch } from 'vue';

interface Props {
    media: Media | null;
    currentType: string;
}

const props = defineProps<Props>();

const getLikedMedias = (): number[] => {
    try {
        return JSON.parse(localStorage.getItem('liked_medias') || '[]');
    } catch {
        return [];
    }
};
const setLikedMedias = (ids: number[]) => {
    localStorage.setItem('liked_medias', JSON.stringify(ids));
    console.log('liked_medias:', localStorage.getItem('liked_medias'));
};

const liked = ref(false);
const likesCount = ref(0);
const viewsCount = ref(0);

watch(
    () => props.media,
    (newMedia) => {
        if (newMedia) {
            const likedMedias = getLikedMedias();
            liked.value = likedMedias.includes(newMedia.id);
            likesCount.value = newMedia.likes_count;
            viewsCount.value = newMedia.views_count;
            // Sumar vista SIEMPRE que se entra a la media
            axios.post(`/media/${newMedia.id}/view`).then((res) => {
                if (res.data && typeof res.data.views_count === 'number') {
                    viewsCount.value = res.data.views_count;
                }
            });
        }
    },
    { immediate: true },
);

const toggleLike = async () => {
    if (!props.media) return;
    const likedMedias = getLikedMedias();
    if (liked.value) {
        // Quitar like
        likesCount.value = Math.max(0, likesCount.value - 1);
        liked.value = false;
        const idx = likedMedias.indexOf(props.media.id);
        if (idx !== -1) likedMedias.splice(idx, 1);
        setLikedMedias(likedMedias);
        await axios.delete(`/media/${props.media.id}/like`).then((res) => {
            if (res.data && typeof res.data.likes_count === 'number') {
                likesCount.value = res.data.likes_count;
            }
        });
    } else {
        // Dar like
        likesCount.value++;
        liked.value = true;
        if (!likedMedias.includes(props.media.id)) likedMedias.push(props.media.id);
        setLikedMedias(likedMedias);
        await axios.post(`/media/${props.media.id}/like`).then((res) => {
            if (res.data && typeof res.data.likes_count === 'number') {
                likesCount.value = res.data.likes_count;
            }
        });
    }
};
</script>

<template>
    <UCard class="h-fit">
        <template #header>
            <div class="flex items-center gap-2">
                <UIcon name="i-lucide-play" class="h-5 w-5 text-primary" />
                <h3 class="font-semibold text-foreground">Reproductor</h3>
            </div>
        </template>
        <div class="p-6">
            <div v-if="props.media" class="space-y-4">
                <div class="aspect-video overflow-hidden rounded-lg bg-muted">
                    <template v-if="props.currentType === 'television' && props.media.file_url">
                        <iframe
                            :src="getYoutubeEmbedUrl(props.media.file_url) + '?showinfo=0&controls=1&rel=0'"
                            frameborder="0"
                            color="white"
                            allowfullscreen
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            class="h-full w-full rounded-lg"
                            title="Reproductor de video de YouTube"
                        ></iframe>
                    </template>
                    <template v-else>
                        <img :src="props.media.cover_image_url" :alt="props.media.title" class="h-full w-full object-cover" />
                    </template>
                </div>
                <!-- Fila de fecha, vistas y likes -->
                <div class="mt-3 flex items-center gap-4 text-xs text-muted-foreground">
                    <span>{{ formatDate(props.media.publication_date) }}</span>
                    <div class="ml-auto flex items-center gap-4">
                        <span class="flex items-center gap-1.5">
                            <UIcon name="i-lucide-eye" class="h-4 w-4" />
                            {{ viewsCount.toLocaleString() }}
                        </span>
                        <button v-if="props.media" @click="toggleLike" class="flex items-center gap-1.5 focus:outline-none">
                            <UIcon
                                :name="liked ? 'i-lucide-thumbs-up' : 'i-lucide-thumbs-up'"
                                :class="liked ? 'h-4 w-4 fill-primary text-primary' : 'h-4 w-4'"
                            />
                            <span :class="liked ? 'font-bold text-primary' : ''">{{ likesCount.toLocaleString() }}</span>
                        </button>
                    </div>
                </div>
                <div>
                    <h4 class="font-semibold text-foreground">{{ props.media.title }}</h4>
                    <p class="mt-2 text-sm text-muted-foreground">
                        {{ props.media.description }}
                    </p>
                    <div class="mt-3 flex items-center gap-4 text-xs text-muted-foreground">
                        <UBadge v-if="props.media.category" :value="props.media.category.name" color="primary" variant="soft" size="xs" />
                    </div>
                </div>
            </div>
            <div v-else class="flex flex-col items-center justify-center py-12 text-center">
                <UIcon name="i-lucide-alert-triangle" class="mb-4 h-16 w-16 text-red-500" />
                <p class="mt-4 text-lg font-semibold text-red-500">Recurso no encontrado</p>
                <p class="text-muted-foreground">Por favor seleccione otro elemento de la lista</p>
            </div>
        </div>
    </UCard>
</template>
