<script setup lang="ts">
import { defineEmits, defineProps, ref } from 'vue';

interface Media {
    id: number;
    title: string;
    description?: string;
    file_url: string;
    cover_image_url?: string;
    type: string;
    publication_date?: string;
    category?: any;
    user?: any;
    views_count: number;
    likes_count: number;
}


const props = defineProps<{ medias: Media[] }>();

console.log()

const emit = defineEmits(['edit']);

const handleEdit = (media: Media) => emit('edit', media);

const copiedId = ref<number | null>(null);
function copyLink(id: number) {
    const url = `/multimedia/television/${id}`;
    navigator.clipboard.writeText(url);
    copiedId.value = id;
    setTimeout(() => {
        copiedId.value = null;
    }, 1500);
}
</script>

<template>
    <div>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            <UCard v-for="media in props.medias" :key="media.id" class="flex flex-col">
                <div class="flex flex-1 flex-col gap-2">
                    <h2 class="line-clamp-2 text-lg font-bold">{{ media.title }}</h2>
                    <div class="flex items-center gap-2 text-xs text-muted-foreground">
                        <span v-if="media.user">👤 {{ media.user.name }}</span>
                        <span v-if="media.category">| 🏷️ {{ media.category.name }}</span>
                        <span>| {{ media.type }}</span>
                    </div>
                    <p class="mt-2 line-clamp-3 text-sm text-muted-foreground">{{ media.description }}</p>
                </div>
                <div class="mt-4 flex justify-end gap-2">
                    <UButton color="primary" variant="soft" @click="handleEdit(media)">Editar</UButton>
                    <UButton v-if="media.type === 'exclusive'" color="primary" variant="outline" @click="copyLink(media.id)">
                        <span v-if="copiedId === media.id">¡Copiado!</span>
                        <span v-else>Copiar link</span>
                    </UButton>
                </div>
            </UCard>
        </div>
    </div>
</template>
