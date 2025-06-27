<script setup lang="ts">
import { router } from '@inertiajs/vue3';
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

console.log();

const emit = defineEmits(['edit']);

const handleEdit = (media: Media) => emit('edit', media);

// Estado para el modal de confirmación
const showConfirm = ref(false);
const mediaToDelete = ref<Media | null>(null);
const loading = ref(false);

const toast = useToast();

const handleDelete = (media: Media) => {
    mediaToDelete.value = media;
    showConfirm.value = true;
};

const confirmDelete = async () => {
    if (!mediaToDelete.value) return;
    loading.value = true;
    router.delete(route('admin.medias.destroy', mediaToDelete.value.id), {
        preserveScroll: true,
        onSuccess: () => {
            toast.add({
                title: 'Media eliminada',
                description: 'La media fue eliminada correctamente.',
                color: 'primary',
                icon: 'i-lucide-check',
            });
        },
        onError: () => {
            toast.add({
                title: 'Error al eliminar',
                description: 'Hubo un error al eliminar la media.',
                color: 'error',
                icon: 'i-lucide-x',
            });
        },
        onFinish: () => {
            loading.value = false;
            showConfirm.value = false;
            mediaToDelete.value = null;
        },
    });
};

const cancelDelete = () => {
    showConfirm.value = false;
    mediaToDelete.value = null;
};

const copiedId = ref<number | null>(null);
function copyLink(id: number) {
    const url = `${window.location.origin}/multimedia/exclusive/${id}`;
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
                    <UButton color="error" variant="soft" @click="handleDelete(media)">Eliminar</UButton>
                    <UButton color="primary" variant="soft" @click="handleEdit(media)">Editar</UButton>
                    <UButton v-if="media.type === 'exclusive'" color="primary" variant="outline" @click="copyLink(media.id)">
                        <span v-if="copiedId === media.id">¡Copiado!</span>
                        <span v-else>Copiar link</span>
                    </UButton>
                </div>
            </UCard>
        </div>

        <!-- Modal de confirmación -->
        <UModal v-model:open="showConfirm" :title="'Confirmar eliminación'">
            <template #content>
                <div class="p-6">
                    <p class="mb-4 text-center text-lg">
                        ¿Estás seguro de que deseas eliminar la media <b>{{ mediaToDelete?.title }}</b
                        >?
                    </p>
                    <div class="mt-6 flex justify-end gap-2">
                        <UButton type="button" color="neutral" variant="outline" @click="cancelDelete" :disabled="loading">Cancelar</UButton>
                        <UButton type="button" color="error" @click="confirmDelete" :loading="loading">Eliminar</UButton>
                    </div>
                </div>
            </template>
        </UModal>
    </div>
</template>
