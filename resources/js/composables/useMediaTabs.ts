import { ref } from 'vue';

export const useMediaTabs = () => {
    const items = ref([
        {
            value: 'television',
            label: 'Televisión',
            icon: 'i-lucide-tv',
        },
        {
            value: 'short_video',
            label: 'Videos Cortos',
            icon: 'i-lucide-video',
        },
        {
            value: 'radio',
            label: 'Radio',
            icon: 'i-lucide-radio',
        },
        {
            value: 'podcast',
            label: 'Podcasts',
            icon: 'i-lucide-headphones',
        },
        {
            value: 'audiobook',
            label: 'Audiolibros',
            icon: 'i-lucide-book-open',
        },
        {
            value: 'exclusive',
            label: 'Exclusivo',
            icon: 'i-lucide-star',
            disabled: true,
        },
    ]);

    // UTabs necesita que los items tengan una propiedad 'slot' para renderizar los templates.
    // Hacemos una copia de los items y añadimos la propiedad 'slot' con el mismo valor que 'value'.
    const itemsWithSlot = ref(items.value.map((item) => ({ ...item, slot: item.value })));

    return { items, itemsWithSlot };
};
