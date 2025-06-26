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

const val1 = ref(['Vue']);
const isEdit = computed(() => !!props.publication && !!props.publication.id);

const state = ref<{
    title: string;
    content: string;
    status: string;
    author_id: number | undefined;
    category_id: number;
    tags: string[];
    references: string[];
    views_count: number;
    id: number | undefined;
}>({
    title: '',
    content: '',
    status: 'active',
    author_id: 1,
    category_id: props.categories.length ? props.categories[0].id : 1,
    tags: [],
    references: [],
    views_count: 0,
    id: undefined,
});

watch(
    () => props.publication,
    (publication) => {
        if (publication) {
            state.value = {
                title: publication.title || '',
                content: publication.content || '',
                status: publication.status || 'active',
                author_id: publication.author_id || undefined,
                category_id: publication.category_id || (props.categories.length ? props.categories[0].id : 1),
                tags: publication.tags ? (Array.isArray(publication.tags) ? publication.tags : JSON.parse(publication.tags)) : [],
                references: publication.references
                    ? Array.isArray(publication.references)
                        ? publication.references
                        : JSON.parse(publication.references)
                    : [],
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
                references: [],
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
        references: JSON.stringify(state.value.references),
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
const userItems = computed(() => props.users.map((u) => ({ label: u.name, value: u.id })));
</script>

<template>
    <UModal v-model:open="internalOpen" fullscreen :title="isEdit ? 'Editar publicación' : 'Agregar publicación'">
        <template #content>
            <div class="mx-auto w-full max-w-2xl p-6">
                <h2 class="mb-6 text-center text-xl font-bold">
                    {{ isEdit ? 'Editar publicación' : 'Agregar publicación' }}
                </h2>
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
                            class="w-full"
                        />
                    </UFormField>

                    <UFormField label="Categoría" name="category_id">
                        <USelect v-model="state.category_id" :items="categoryItems" value-key="id" class="w-full" />
                    </UFormField>

                    <UFormField label="Autor" name="author_id">
                        <USelect v-model="state.author_id" :items="userItems" class="w-full" />
                    </UFormField>

                    <UFormField label="Etiquetas (tags)" name="tags">
                        <UInputTags v-model="val1" class="w-full" />
                    </UFormField>

                    <UFormField label="Referencias" name="references">
                        <UInputTags v-model="state.references" class="w-full" />
                    </UFormField>

                    <UFormField v-if="isEdit" label="Vistas" name="views_count">
                        <UInput v-model="state.views_count" class="w-full" readonly />
                    </UFormField>

                    <div class="mt-6 flex justify-end gap-2">
                        <UButton type="button" color="neutral" variant="outline" @click="emit('update:open', false)">Cancelar</UButton>
                        <UButton type="submit" color="primary">{{ isEdit ? 'Actualizar' : 'Crear' }}</UButton>
                    </div>
                </UForm>
            </div>
        </template>
    </UModal>
</template>
