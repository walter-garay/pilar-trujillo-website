<script setup lang="ts">
import type { Category, Publication } from '@/types';
import { router } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';

const props = defineProps<{ publication: Publication | null; open: boolean; categories: Category[]; users: any[] }>();
const emit = defineEmits(['update:open']);

const internalOpen = ref(props.open);

watch(
    () => props.open,
    (val) => (internalOpen.value = val),
);

watch(internalOpen, (val) => emit('update:open', val));

const isEdit = computed(() => !!props.publication && !!props.publication.id);

const state = ref<{
    title: string;
    content: string;
    status: string;
    author_id: number | undefined;
    category_id: number;
    tags: string[];
    source_name: string;
    source_url: string;
    views_count: number;
    id: number | undefined;
}>({
    title: '',
    content: '',
    status: 'active',
    author_id: 1,
    category_id: props.categories.length ? props.categories[0].id : 1,
    tags: [],
    source_name: '',
    source_url: '',
    views_count: 0,
    id: undefined,
});

watch(
    () => props.publication,
    (publication) => {
        if (publication) {
            const references = publication.references
                ? Array.isArray(publication.references)
                    ? publication.references
                    : JSON.parse(publication.references)
                : {};

            state.value = {
                title: publication.title || '',
                content: publication.content || '',
                status: publication.status || 'active',
                author_id: publication.author_id || undefined,
                category_id: publication.category_id || (props.categories.length ? props.categories[0].id : 1),
                tags: Array.isArray(publication.tags) ? publication.tags : JSON.parse(publication.tags || '[]'),
                source_name: references.name || '',
                source_url: references.url || '',
                views_count: publication.views_count || 0,
                id: publication.id,
            };
        } else {
            state.value = {
                title: '',
                content: '',
                status: 'active',
                author_id: undefined,
                category_id: props.categories.length ? props.categories[0].id : 1,
                tags: [],
                source_name: '',
                source_url: '',
                views_count: 0,
                id: undefined,
            };
        }
    },
    { immediate: true },
);

const toast = useToast();

const onSubmit = () => {
    const payload = {
        title: state.value.title,
        content: state.value.content,
        status: state.value.status,
        author_id: state.value.author_id,
        category_id: state.value.category_id,
        tags: JSON.stringify(state.value.tags),
        references: JSON.stringify({
            name: state.value.source_name,
            url: state.value.source_url,
        }),
        views_count: state.value.views_count,
    };

    if (isEdit.value && props.publication?.id) {
        router.put(route('admin.publications.update', props.publication.id), payload, {
            preserveScroll: true,
            onSuccess: () => {
                toast.add({
                    title: 'Publicación actualizada',
                    description: 'La publicación fue actualizada correctamente.',
                    color: 'primary',
                    icon: 'i-lucide-check',
                });
                emit('update:open', false);
            },
            onError: () => {
                toast.add({
                    title: 'Error al actualizar',
                    description: 'Hubo un error al actualizar la publicación.',
                    color: 'error',
                    icon: 'i-lucide-x',
                });
            },
        });
    } else {
        router.post(route('admin.publications.store'), payload, {
            preserveScroll: true,
            onSuccess: () => {
                toast.add({
                    title: 'Publicación creada',
                    description: 'La publicación fue creada correctamente.',
                    color: 'primary',
                    icon: 'i-lucide-check',
                });
                emit('update:open', false);
            },
            onError: () => {
                toast.add({
                    title: 'Error al crear',
                    description: 'Hubo un error al crear la publicación.',
                    color: 'error',
                    icon: 'i-lucide-x',
                });
            },
        });
    }
};

const categoryItems = computed(() => props.categories.map((c) => ({ label: c.name, id: c.id })));
</script>

<template>
    <UModal v-model:open="internalOpen" fullscreen :title="isEdit ? 'Editar publicación' : 'Agregar publicación'" :class="'z-[10]'">
        <template #body>
            <div class="mx-auto flex min-h-full w-full max-w-2xl items-center justify-center p-6">
                <div class="w-full">
                    <UForm :state="state" class="space-y-4" @submit="onSubmit">
                        <UFormField label="Título" name="title">
                            <UInput v-model="state.title" required class="w-full" />
                        </UFormField>

                        <UFormField label="Contenido" name="content">
                            <UTextarea v-model="state.content" class="min-h-[120px] w-full" />
                        </UFormField>

                        <UFormField label="Estado" name="status">
                            <USelect
                                v-model="state.status"
                                :items="[
                                    { label: 'Activo', value: 'active' },
                                    { label: 'Archivado', value: 'archived' },
                                ]"
                                :portal="false"
                                class="w-full"
                            />
                        </UFormField>

                        <UFormField label="Categoría" name="category_id">
                            <USelect v-model="state.category_id" :items="categoryItems" value-key="id" class="w-full" :portal="false" />
                        </UFormField>

                        <UFormField label="Etiquetas (tags)" name="tags">
                            <UInputTags v-model="state.tags" class="w-full" :class="'z-[8]'" />
                        </UFormField>

                        <div class="space-y-4">
                            <h3 class="text-lg font-medium">Fuente</h3>
                            <UFormField label="Nombre de la fuente" name="source_name">
                                <UInput v-model="state.source_name" placeholder="Nombre de la fuente" class="w-full" />
                            </UFormField>
                            <UFormField label="Link de la fuente" name="source_url">
                                <UInput v-model="state.source_url" placeholder="Link de la fuente" class="w-full" />
                            </UFormField>
                        </div>

                        <UFormField v-if="isEdit" label="Vistas" name="views_count">
                            <UInput v-model="state.views_count" class="w-full" readonly />
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
