<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import type { Sponsor } from '@/types';
import { Head } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import SponsorList from './components/SponsorList.vue';
import SponsorModal from './components/SponsorModal.vue';

interface Props {
    sponsors: Sponsor[];
}

const props = defineProps<Props>();

const search = ref('');
const filteredSponsors = computed(() => {
    if (!search.value) return props.sponsors;
    return props.sponsors.filter((s) => s.name.toLowerCase().includes(search.value.toLowerCase()));
});

const showModal = ref(false);
const editingSponsor = ref<Sponsor | null>(null);

const handleAddSponsor = () => {
    editingSponsor.value = null;
    showModal.value = true;
};

const handleEditSponsor = (sponsor: Sponsor) => {
    editingSponsor.value = sponsor;
    showModal.value = true;
};

const handleCloseModal = () => {
    showModal.value = false;
    editingSponsor.value = null;
};
</script>

<template>
    <Head title="Administrar de Sponsors" />
    <AppLayout>
        <div class="p-6">
            <h1 class="mb-6 text-2xl font-bold">Auspiciadores</h1>
            <div class="mb-6 flex items-center gap-4">
                <UInput v-model="search" placeholder="Buscar auspiciador por su nombre" class="w-full max-w-xs" />
                <UButton color="primary" @click="handleAddSponsor">Agregar auspiciador</UButton>
            </div>
            <SponsorList :sponsors="filteredSponsors" @edit="handleEditSponsor" />
            <SponsorModal :sponsor="editingSponsor" :open="showModal" @update:open="showModal = $event" @close="handleCloseModal" />
        </div>
    </AppLayout>
</template>
