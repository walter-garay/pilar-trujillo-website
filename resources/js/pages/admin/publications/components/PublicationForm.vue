<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import type { Category, Publication } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import { computed, onMounted, ref, watch } from 'vue';

import Quill from 'quill'; // Core build sin módulos
import 'quill/dist/quill.snow.css';

interface Props {
    publication?: Publication | null;
    categories: Category[];
    isEdit?: boolean;
}

const props = defineProps<Props>();

const state = ref<{
    title: string;
    content: string;
    status: string;
    category_id: number;
    tags: string[];
    source_name: string;
    source_url: string;
    views_count: number;
}>({
    title: '',
    content: '',
    status: 'active',
    category_id: props.categories.length ? props.categories[0].id : 1,
    tags: [],
    source_name: '',
    source_url: '',
    views_count: 0,
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
                category_id: publication.category_id || (props.categories.length ? props.categories[0].id : 1),
                tags: Array.isArray(publication.tags) ? publication.tags : JSON.parse(publication.tags || '[]'),
                source_name: references.name || '',
                source_url: references.url || '',
                views_count: publication.views_count || 0,
            };
        }
    },
    { immediate: true },
);

const toast = useToast();

const images = ref<File[]>([]);
const imagePreviews = ref<string[]>([]);
const existingImages = ref<{ id: number; file_url: string }[]>(
    (props.publication?.images || []).map((img: any, idx: number) => ({
        id: img.id ?? idx,
        file_url: img.file_url,
    })),
);
const imagesToDelete = ref<number[]>([]);

function handleImageChange(e: Event) {
    const target = e.target as HTMLInputElement;
    if (target.files) {
        const files = Array.from(target.files).slice(0, 5);
        images.value = files;
        imagePreviews.value = files.map((file) => URL.createObjectURL(file));
    }
}

function removeImage(index: number) {
    images.value.splice(index, 1);
    imagePreviews.value.splice(index, 1);
}

function getImageUrl(url: string) {
    if (!url) return '';
    if (url.startsWith('/assets') || url.startsWith('http')) return url;
    return '/storage/' + url.replace(/^storage[\\/]/, '');
}

function removeExistingImage(idx: number) {
    imagesToDelete.value.push(existingImages.value[idx].id);
    existingImages.value.splice(idx, 1);
}

const onSubmit = () => {
    const payload = new FormData();
    payload.append('title', state.value.title);
    payload.append('content', state.value.content);
    payload.append('status', state.value.status);
    payload.append('category_id', String(state.value.category_id));
    payload.append('tags', JSON.stringify(state.value.tags));
    payload.append(
        'references',
        JSON.stringify({
            name: state.value.source_name,
            url: state.value.source_url,
        }),
    );
    payload.append('views_count', String(state.value.views_count));
    images.value.forEach((file) => {
        payload.append('images[]', file);
    });
    imagesToDelete.value.forEach((id) => {
        payload.append('delete_images[]', String(id));
    });

    if (props.isEdit && props.publication?.id) {
        router.post(route('admin.publications.update', props.publication.id), payload, {
            forceFormData: true,
            onSuccess: () => {
                toast.add({
                    title: 'Publicación actualizada',
                    description: 'La publicación fue actualizada correctamente.',
                    color: 'primary',
                    icon: 'i-lucide-check',
                });
                router.visit(route('admin.publications'));
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
            forceFormData: true,
            onSuccess: () => {
                toast.add({
                    title: 'Publicación creada',
                    description: 'La publicación fue creada correctamente.',
                    color: 'primary',
                    icon: 'i-lucide-check',
                });
                router.visit(route('admin.publications'));
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

const goBack = () => {
    router.visit(route('admin.publications'));
};

const categoryItems = computed(() => props.categories.map((c) => ({ label: c.name, id: c.id })));

const editorRef = ref<HTMLDivElement | null>(null);
const quillEditor = ref<any>(null);

onMounted(() => {
    if (editorRef.value) {
        quillEditor.value = new Quill(editorRef.value, {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ header: [1, 2, 3, 4, 5, 6, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ color: [] }, { background: [] }],
                    [{ list: 'ordered' }, { list: 'bullet' }],
                    [{ indent: '-1' }, { indent: '+1' }],
                    [{ align: [] }],
                    ['link', 'blockquote'],
                    ['clean'],
                ],
                clipboard: {
                    matchVisual: false,
                },
            },
            placeholder: 'Escribe el contenido de tu publicación...',
        });

        // Sincronizar contenido inicial si estamos editando
        if (props.publication?.content) {
            quillEditor.value.root.innerHTML = props.publication.content;
        }

        // Sincronizar cambios con el estado
        quillEditor.value.on('text-change', () => {
            state.value.content = quillEditor.value.root.innerHTML;
        });
    }
});

// Sincronizar cuando cambie la publicación
watch(
    () => props.publication,
    (publication) => {
        if (publication && quillEditor.value) {
            quillEditor.value.root.innerHTML = publication.content || '';
        }
    },
    { immediate: true },
);
</script>

<template>
    <Head :title="isEdit ? 'Editar Publicación' : 'Crear Publicación'" />
    <AppLayout>
        <div class="container mx-auto max-w-4xl px-4 py-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-foreground">
                            {{ isEdit ? 'Editar publicación' : 'Crear publicación' }}
                        </h1>
                        <p class="mt-2 text-muted-foreground">
                            {{ isEdit ? 'Modifica los datos de la publicación' : 'Completa el formulario para crear una nueva publicación' }}
                        </p>
                    </div>
                    <UButton color="neutral" variant="outline" icon="i-lucide-arrow-left" @click="goBack"> Volver </UButton>
                </div>
            </div>

            <!-- Form -->
            <div class="rounded-lg border bg-card p-6 shadow-sm">
                <UForm :state="state" class="space-y-6" @submit="onSubmit">
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <!-- Columna izquierda -->
                        <div class="space-y-6">
                            <UFormField label="Título" name="title">
                                <UInput v-model="state.title" required class="w-full" placeholder="Título de la publicación" />
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

                            <UFormField label="Etiquetas (tags)" name="tags">
                                <UInputTags v-model="state.tags" class="w-full" placeholder="Agregar etiquetas..." />
                            </UFormField>

                            <UFormField v-if="isEdit" label="Vistas" name="views_count">
                                <UInput v-model="state.views_count" class="w-full" />
                            </UFormField>
                        </div>

                        <!-- Columna derecha -->
                        <div class="space-y-6">
                            <div class="mb-6">
                                <label class="mb-2 block text-sm font-medium text-foreground">Imágenes (máx. 5)</label>
                                <input
                                    type="file"
                                    accept="image/*"
                                    multiple
                                    @change="handleImageChange"
                                    :disabled="images.length + existingImages.length >= 5"
                                />
                                <div class="mt-2 flex flex-wrap gap-4">
                                    <div v-for="(img, idx) in existingImages" :key="img.id" class="relative h-24 w-24">
                                        <img :src="getImageUrl(img.file_url)" class="h-full w-full rounded border object-cover" />
                                        <button
                                            type="button"
                                            @click="removeExistingImage(idx)"
                                            class="absolute top-1 right-1 flex h-6 w-6 items-center justify-center rounded-full bg-red-500 text-white"
                                        >
                                            &times;
                                        </button>
                                    </div>
                                    <div v-for="(src, idx) in imagePreviews" :key="'new-' + idx" class="relative h-24 w-24">
                                        <img :src="src" class="h-full w-full rounded border object-cover" />
                                        <button
                                            type="button"
                                            @click="removeImage(idx)"
                                            class="absolute top-1 right-1 flex h-6 w-6 items-center justify-center rounded-full bg-red-500 text-white"
                                        >
                                            &times;
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <h3 class="text-lg font-medium">Fuente</h3>
                                <UFormField label="Nombre de la fuente" name="source_name">
                                    <UInput v-model="state.source_name" placeholder="Nombre de la fuente" class="w-full" />
                                </UFormField>
                                <UFormField label="Link de la fuente" name="source_url">
                                    <UInput v-model="state.source_url" placeholder="https://ejemplo.com" class="w-full" />
                                </UFormField>
                            </div>
                        </div>
                    </div>

                    <!-- Contenido (ancho completo) -->
                    <UFormField label="Contenido" name="content">
                        <div ref="editorRef" class="min-h-[400px] rounded-md border border-gray-300 bg-white" />
                    </UFormField>

                    <!-- Botones -->
                    <div class="flex justify-end gap-3 border-t pt-6">
                        <UButton type="button" color="neutral" variant="outline" @click="goBack"> Cancelar </UButton>
                        <UButton type="submit" color="primary" :loading="false">
                            {{ isEdit ? 'Guardar cambios' : 'Guardar ' }}
                        </UButton>
                    </div>
                </UForm>
            </div>
        </div>
    </AppLayout>
</template>
