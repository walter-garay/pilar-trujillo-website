<script setup lang="ts">
import type { Media } from '@/types';
import { router } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';
import { route } from 'ziggy-js';

const props = defineProps<{ media: Media | null; open: boolean; type: string; categories: any[] }>();
const emit = defineEmits(['update:open']);

const internalOpen = ref(props.open);
watch(
    () => props.open,
    (val) => (internalOpen.value = val),
);
watch(internalOpen, (val) => emit('update:open', val));

const isEdit = computed(() => !!props.media && !!props.media.id);

const state = ref({
    title: '',
    description: '',
    file_url: '',
    cover_image_url: '',
    type: props.type,
    publication_date: '',
    category_id: 1,
    tags: [] as string[],
});

watch(
    () => props.media,
    (media) => {
        if (media) {
            let tags: string[] = [];
            console.log('MediaModal props:', { media: props.media, open: props.open, type: props.type });

            if (typeof media.tags === 'string') {
                try {
                    tags = JSON.parse(media.tags || '[]');
                } catch {
                    tags = [];
                }
            } else if (Array.isArray(media.tags)) {
                tags = media.tags;
            }
            state.value = {
                title: media.title || '',
                description: media.description || '',
                file_url: media.file_url || '',
                cover_image_url: media.cover_image_url || '',
                type: media.type || props.type,
                publication_date: media.publication_date || '',
                category_id: media.category_id,
                tags,
            };
        } else {
            state.value = {
                title: '',
                description: '',
                file_url: '',
                cover_image_url: '',
                type: props.type,
                publication_date: '',
                category_id: 1,
                tags: [],
            };
        }
    },
    { immediate: true },
);

const toast = useToast();

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

const modalTitle = computed(() => {
    const base = isEdit.value ? 'Editar media' : 'Agregar contenido';
    const typeLabel = typeTitles[props.type] || props.type;
    return `${base} (${typeLabel})`;
});

const categoryItems = computed(() => props.categories.map((c) => ({ label: c.name, id: c.id })));

const onSubmit = () => {
    const payload = { ...state.value, tags: JSON.stringify(state.value.tags) };
    console.log('MediaModal onSubmit payload:', payload);
    if (isEdit.value && props.media?.id) {
        router.put(route('admin.medias.update', props.media.id), payload, {
            preserveScroll: true,
            onSuccess: () => {
                toast.add({
                    title: 'Media actualizada',
                    description: 'La media fue actualizada correctamente.',
                    color: 'primary',
                    icon: 'i-lucide-check',
                });
                emit('update:open', false);
            },
            onError: () => {
                toast.add({
                    title: 'Error al actualizar',
                    description: 'Hubo un error al actualizar la media.',
                    color: 'error',
                    icon: 'i-lucide-x',
                });
            },
        });
    } else {
        router.post(route('admin.medias.store'), payload, {
            preserveScroll: true,
            onSuccess: () => {
                toast.add({
                    title: 'Media creada',
                    description: 'La media fue creada correctamente.',
                    color: 'primary',
                    icon: 'i-lucide-check',
                });
                emit('update:open', false);
            },
            onError: () => {
                toast.add({
                    title: 'Error al crear',
                    description: 'Hubo un error al crear la media.',
                    color: 'error',
                    icon: 'i-lucide-x',
                });
            },
        });
    }
};
</script>

<template>
    <UModal v-model:open="internalOpen" fullscreen :title="modalTitle" :class="'z-[1200]'">
        <template #body>
            <div class="mx-auto flex min-h-full w-full max-w-2xl items-center justify-center p-6">
                <div class="w-full">
                    <UForm :state="state" class="space-y-4" @submit="onSubmit">
                        <UFormField label="Título" name="title">
                            <UInput v-model="state.title" required class="w-full" />
                        </UFormField>
                        <UFormField label="Descripción" name="description">
                            <UTextarea v-model="state.description" class="min-h-[80px] w-full" />
                        </UFormField>
                        <UFormField label="Archivo (URL)" name="file_url">
                            <UInput v-model="state.file_url" required class="w-full" />
                        </UFormField>
                        <UFormField label="Imagen de portada (URL)" name="cover_image_url">
                            <UInput v-model="state.cover_image_url" class="w-full" />
                        </UFormField>
                        <UFormField label="Tipo" name="type">
                            <UInput v-model="state.type" class="w-full" disabled />
                        </UFormField>
                        <UFormField label="Fecha de publicación" name="publication_date">
                            <UInput v-model="state.publication_date" type="datetime-local" class="w-full" />
                        </UFormField>
                        <UFormField label="Categoría" name="category_id">
                            <USelect v-model="state.category_id" :items="categoryItems" value-key="id" class="w-full" />
                        </UFormField>
                        <UFormField label="Etiquetas (tags)" name="tags">
                            <UInputTags v-model="state.tags" class="w-full" />
                        </UFormField>
                        <div class="mt-6 flex justify-end gap-2">
                            <UButton type="button" color="neutral" variant="outline" @click="emit('update:open', false)">Cancelar</UButton>
                            <UButton type="submit" color="primary">{{ isEdit ? 'Actualizar' : 'Crear' }}</UButton>
                        </div>
                    </UForm>
                </div>
            </div>
        </template>
    </UModal>
</template>
