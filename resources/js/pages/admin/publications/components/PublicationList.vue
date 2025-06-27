<script setup lang="ts">
import type { Publication } from '@/types';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';

interface Props {
    publications: Publication[];
}

const props = defineProps<Props>();
const emit = defineEmits(['edit']);

const handleEdit = (publication: Publication) => emit('edit', publication);

// Estado para el modal de confirmación
const showConfirm = ref(false);
const publicationToDelete = ref<Publication | null>(null);
const loading = ref(false);

const toast = useToast();

const handleDelete = (publication: Publication) => {
    publicationToDelete.value = publication;
    showConfirm.value = true;
};

const confirmDelete = async () => {
    if (!publicationToDelete.value) return;
    loading.value = true;
    router.delete(route('admin.publications.destroy', publicationToDelete.value.id), {
        preserveScroll: true,
        onSuccess: () => {
            toast.add({
                title: 'Publicación eliminada',
                description: 'La publicación fue eliminada correctamente.',
                color: 'primary',
                icon: 'i-lucide-check',
            });
        },
        onError: () => {
            toast.add({
                title: 'Error al eliminar',
                description: 'Hubo un error al eliminar la publicación.',
                color: 'error',
                icon: 'i-lucide-x',
            });
        },
        onFinish: () => {
            loading.value = false;
            showConfirm.value = false;
            publicationToDelete.value = null;
        },
    });
};

const cancelDelete = () => {
    showConfirm.value = false;
    publicationToDelete.value = null;
};
</script>

<template>
    <div>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            <UCard v-for="pub in props.publications" :key="pub.id" class="flex flex-col">
                <div class="flex flex-1 flex-col gap-2">
                    <div v-if="pub.images && pub.images.length" class="mb-2">
                        <img :src="pub.images[0].file_url" :alt="pub.title" class="h-40 w-full rounded object-cover" />
                    </div>
                    <h2 class="line-clamp-2 text-lg font-bold">{{ pub.title }}</h2>
                    <div class="flex items-center gap-2 text-xs text-muted-foreground">
                        <span v-if="pub.author">👤 {{ pub.author.name }}</span>
                        <span v-if="pub.category">| 🏷️ {{ pub.category.name }}</span>
                        <span
                            >| Estado:
                            <span :class="pub.status === 'active' ? 'text-green-600' : 'text-yellow-600'">{{
                                pub.status === 'active' ? 'Activo' : 'Archivado'
                            }}</span></span
                        >
                    </div>
                    <div v-if="pub.tags" class="mt-1 flex flex-wrap gap-1">
                        <UBadge v-for="tag in JSON.parse(pub.tags)" :key="tag" color="neutral" variant="soft">#{{ tag }}</UBadge>
                    </div>
                    <p class="mt-2 line-clamp-3 text-sm text-muted-foreground">{{ pub.content }}</p>
                    <div v-if="pub.references" class="mt-2 text-xs text-muted-foreground">
                        <span v-if="JSON.parse(pub.references).name">📚 Fuente: {{ JSON.parse(pub.references).name }}</span>
                    </div>
                </div>
                <div class="mt-4 flex justify-end gap-2">
                    <UButton color="error" variant="soft" @click="handleDelete(pub)">Eliminar</UButton>
                    <UButton color="primary" variant="soft" @click="handleEdit(pub)">Editar</UButton>
                </div>
            </UCard>
        </div>

        <!-- Modal de confirmación -->
        <UModal v-model:open="showConfirm" :title="'Confirmar eliminación'">
            <template #content>
                <div class="p-6">
                    <p class="mb-4 text-center text-lg">
                        ¿Estás seguro de que deseas eliminar la publicación <b>{{ publicationToDelete?.title }}</b
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
