<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';

import type { Sponsor } from '@/types';

const props = defineProps<{ sponsor: Sponsor | null; open: boolean }>();
const emit = defineEmits(['close', 'update:open']);

const internalOpen = ref(props.open);
watch(
    () => props.open,
    (val) => (internalOpen.value = val),
);
watch(internalOpen, (val) => emit('update:open', val));

const isEdit = computed(() => !!props.sponsor);

const state = ref({
    name: '',
    logo: null as File | null,
    description: '',
    email: '',
    phone: '',
    media_url: '',
    website_url: '',
    promotion_start: '',
    promotion_end: '',
});

// Calcular días de auspicio
const daysOfSponsorship = computed(() => {
    if (!state.value.promotion_start || !state.value.promotion_end) return 0;

    const startDate = new Date(state.value.promotion_start);
    const endDate = new Date(state.value.promotion_end);

    if (startDate >= endDate) return 0;

    const diffTime = endDate.getTime() - startDate.getTime();
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

    return diffDays;
});

watch(
    () => props.sponsor,
    (sponsor) => {
        if (sponsor) {
            state.value = {
                name: sponsor.name || '',
                logo: null,
                description: sponsor.description || '',
                email: sponsor.email || '',
                phone: sponsor.phone || '',
                media_url: sponsor.media_url || '',
                website_url: sponsor.website_url || '',
                promotion_start: sponsor.promotion_start || '',
                promotion_end: sponsor.promotion_end || '',
            };
        } else {
            state.value = {
                name: '',
                logo: null,
                description: '',
                email: '',
                phone: '',
                media_url: '',
                website_url: '',
                promotion_start: '',
                promotion_end: '',
            };
        }
    },
    { immediate: true },
);

const handleFileChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files.length > 0) {
        state.value.logo = target.files[0];
    } else {
        state.value.logo = null;
    }
};

const toast = useToast();

const onSubmit = () => {
    const formData = new FormData();
    formData.append('name', state.value.name);
    formData.append('description', state.value.description);
    formData.append('email', state.value.email);
    formData.append('phone', state.value.phone);
    formData.append('media_url', state.value.media_url);
    formData.append('website_url', state.value.website_url);
    formData.append('promotion_start', state.value.promotion_start);
    formData.append('promotion_end', state.value.promotion_end);
    if (state.value.logo) {
        formData.append('logo', state.value.logo);
    }

    if (isEdit.value && props.sponsor) {
        router.post(route('admin.sponsors.update', props.sponsor.id), formData, {
            forceFormData: true,
            preserveScroll: true,
            onSuccess: () => {
                toast.add({
                    title: 'Auspiciador actualizado',
                    description: 'El auspiciador fue actualizado correctamente.',
                    color: 'primary',
                    icon: 'i-lucide-check',
                });
                emit('update:open', false);
            },
            onError: () => {
                toast.add({
                    title: 'Error al actualizar',
                    description: 'Hubo un error al actualizar el auspiciador.',
                    color: 'error',
                    icon: 'i-lucide-x',
                });
            },
        });
    } else {
        router.post(route('admin.sponsors.store'), formData, {
            forceFormData: true,
            preserveScroll: true,
            onSuccess: () => {
                toast.add({
                    title: 'Auspiciador creado',
                    description: 'El auspiciador fue creado correctamente.',
                    color: 'primary',
                    icon: 'i-lucide-check',
                });
                emit('update:open', false);
            },
            onError: () => {
                toast.add({
                    title: 'Error al crear',
                    description: 'Hubo un error al crear el auspiciador.',
                    color: 'error',
                    icon: 'i-lucide-x',
                });
            },
        });
    }
};
</script>

<template>
    <UModal v-model:open="internalOpen" :title="isEdit ? 'Editar auspiciador' : 'Agregar auspiciador'" fullscreen :class="'z-[1200]'">
        <template #body>
            <div class="mx-auto flex min-h-full w-full max-w-lg items-center justify-center p-6">
                <div class="w-full">
                    <UForm :state="state" class="space-y-4" @submit="onSubmit">
                        <UFormField label="Nombre" name="name">
                            <UInput v-model="state.name" required class="w-full" />
                        </UFormField>

                        <UFormField label="Logo" name="logo">
                            <input type="file" accept="image/*" @change="handleFileChange" class="w-full" />
                        </UFormField>

                        <UFormField label="Descripción corta" name="description">
                            <UTextarea v-model="state.description" class="w-full" :rows="2" />
                        </UFormField>

                        <UFormField label="Sitio web o red social (Facebook, Instagram, etc.)" name="website_url">
                            <UInput v-model="state.website_url" class="w-full" />
                        </UFormField>

                        <UFormField label="Link del video publicitario (Youtube)" name="media_url">
                            <UInput v-model="state.media_url" class="w-full" />
                        </UFormField>

                        <div class="flex flex-col gap-4 md:flex-row">
                            <UFormField label="Inicio del auspicio" name="promotion_start" class="flex-1">
                                <UInput v-model="state.promotion_start" type="datetime-local" class="w-full" />
                            </UFormField>
                            <UFormField label="Fin del auspicio" name="promotion_end" class="flex-1">
                                <UInput v-model="state.promotion_end" type="datetime-local" class="w-full" />
                            </UFormField>
                        </div>

                        <div v-if="daysOfSponsorship > 0" class="rounded-md bg-blue-50 p-3">
                            <p class="text-sm text-blue-700">
                                <strong>Duración del auspicio:</strong> {{ daysOfSponsorship }} día{{ daysOfSponsorship !== 1 ? 's' : '' }}
                            </p>
                        </div>

                        <div class="pt-2">
                            <div class="mb-2 text-sm font-semibold text-neutral-700">Información de contacto extra</div>
                            <div class="flex flex-col gap-4 md:flex-row">
                                <UFormField label="Email" name="email" class="flex-1">
                                    <UInput v-model="state.email" type="email" class="w-full" />
                                </UFormField>
                                <UFormField label="Número o teléfono" name="phone" class="flex-1">
                                    <UInput v-model="state.phone" class="w-full" />
                                </UFormField>
                            </div>
                        </div>

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
