<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import type { Sponsor } from '@/types';
import { Head } from '@inertiajs/vue3';
import SponsorList from '../components/SponsorList.vue';

interface Props {
    sponsors: Sponsor[];
}

const props = defineProps<Props>();
</script>

<template>
    <Head title="Administrar Sponsors" />
    <AppLayout>
        <div class="p-6">
            <h1 class="mb-6 text-2xl font-bold">Mis auspiciadores</h1>
            <SponsorList :sponsors="props.sponsors" />
        </div>
    </AppLayout>
</template>
