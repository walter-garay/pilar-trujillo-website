<script setup lang="ts">
import { useMediaTabs } from '@/composables/useMediaTabs';
import { router } from '@inertiajs/vue3';

interface Props {
    selectedType: string;
}

const props = defineProps<Props>();
const { items } = useMediaTabs();

// Función para cambiar de tab
const changeTab = (type: string | number) => {
    if (typeof type === 'string') {
        router.get(
            '/multimedia',
            { tab: type },
            {
                preserveState: true,
                preserveScroll: true,
            },
        );
    }
};
</script>

<template>
    <div class="mb-8">
        <UTabs :items="items" :default-value="props.selectedType" @update:model-value="changeTab" class="w-full" size="lg" color="primary" variant="pill" />
    </div>
</template>
