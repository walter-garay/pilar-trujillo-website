<script setup lang="ts">
import type { Sponsor } from '@/types';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';

interface Props {
    sponsors: Sponsor[];
}

const props = defineProps<Props>();

const emit = defineEmits(['edit']);

const handleEdit = (sponsor: Sponsor) => {
    emit('edit', sponsor);
};

// Estado para el modal de confirmación
const showConfirm = ref(false);
const sponsorToDelete = ref<Sponsor | null>(null);
const loading = ref(false);

const toast = useToast();

const handleDelete = (sponsor: Sponsor) => {
    sponsorToDelete.value = sponsor;
    showConfirm.value = true;
};

const confirmDelete = async () => {
    if (!sponsorToDelete.value) return;
    loading.value = true;
    router.delete(route('admin.sponsors.destroy', sponsorToDelete.value.id), {
        preserveScroll: true,
        onSuccess: () => {
            toast.add({
                title: 'Auspiciador eliminado',
                description: 'El auspiciador fue eliminado correctamente.',
                color: 'primary',
                icon: 'i-lucide-check',
            });
        },
        onError: () => {
            toast.add({
                title: 'Error al eliminar',
                description: 'Hubo un error al eliminar el auspiciador.',
                color: 'error',
                icon: 'i-lucide-x',
            });
        },
        onFinish: () => {
            loading.value = false;
            showConfirm.value = false;
            sponsorToDelete.value = null;
        },
    });
};

const cancelDelete = () => {
    showConfirm.value = false;
    sponsorToDelete.value = null;
};

function getLogoUrl(url: string) {
    if (!url) return '';
    if (url.startsWith('/assets') || url.startsWith('http')) return url;
    return '/storage/' + url.replace(/^storage[\\/]/, '');
}
</script>

<template>
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        <!-- Card de auspiciador -->
        <UCard v-for="sponsor in props.sponsors" :key="sponsor.id" class="flex flex-col">
            <div class="mb-4 flex items-center gap-4">
                <img
                    v-if="sponsor.logo_url"
                    :src="getLogoUrl(sponsor.logo_url)"
                    :alt="sponsor.name"
                    class="h-16 w-16 rounded-full border object-cover"
                />
                <div>
                    <h2 class="text-lg font-bold">{{ sponsor.name }}</h2>
                    <p class="text-xs text-muted-foreground">{{ sponsor.email }}</p>
                </div>
            </div>
            <p class="mb-2 text-sm text-muted-foreground">{{ sponsor.description }}</p>
            <div class="mb-2"><span class="font-semibold">Teléfono:</span> {{ sponsor.phone }}</div>
            <div class="mb-2">
                <span class="font-semibold">URL:</span>
                <a :href="sponsor.media_url" class="text-primary underline" target="_blank">{{ sponsor.media_url }}</a>
            </div>
            <div class="mb-2">
                <span class="font-semibold">Website:</span>
                <a v-if="sponsor.website_url" :href="sponsor.website_url" class="text-primary underline" target="_blank">{{ sponsor.website_url }}</a>
                <span v-else>-</span>
            </div>
            <div class="mb-2">
                <span class="font-semibold">Promoción:</span>
                <span v-if="sponsor.promotion_start">{{ new Date(sponsor.promotion_start).toLocaleString() }}</span>
                <span v-else>-</span>
                &nbsp;—&nbsp;
                <span v-if="sponsor.promotion_end">{{ new Date(sponsor.promotion_end).toLocaleString() }}</span>
                <span v-else>-</span>
            </div>
            <div v-if="sponsor.social_media_urls" class="mt-2 flex gap-2">
                <span v-for="(url, key) in JSON.parse(sponsor.social_media_urls)" :key="key">
                    <a :href="url" class="text-xs text-blue-500 underline" target="_blank">{{ key }}</a>
                </span>
            </div>
            <div class="mt-4 flex justify-end gap-2">
                <UButton color="error" variant="soft" @click="handleDelete(sponsor)">Eliminar</UButton>
                <UButton color="primary" variant="soft" @click="handleEdit(sponsor)">Editar</UButton>
            </div>
        </UCard>
    </div>

    <!-- Modal de confirmación -->
    <UModal v-model:open="showConfirm" :title="'Confirmar eliminación'">
        <template #content>
            <div class="p-6">
                <p class="mb-4 text-center text-lg">
                    ¿Estás seguro de que deseas eliminar el auspiciador <b>{{ sponsorToDelete?.name }}</b
                    >?
                </p>
                <div class="mt-6 flex justify-end gap-2">
                    <UButton type="button" color="neutral" variant="outline" @click="cancelDelete" :disabled="loading">Cancelar</UButton>
                    <UButton type="button" color="error" @click="confirmDelete" :loading="loading">Eliminar</UButton>
                </div>
            </div>
        </template>
    </UModal>
</template>
