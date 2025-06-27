<script setup lang="ts">
// Carrusel vertical fluido con CSS animation, dos columnas en sentidos opuestos
const galleryImages1 = [
    '/assets/images/gallery/1.jpg',
    '/assets/images/gallery/2.jpg',
    '/assets/images/gallery/3.jpg',
    '/assets/images/gallery/4.jpg',
    '/assets/images/gallery/5.jpg',
    '/assets/images/gallery/6.jpg',
    '/assets/images/gallery/7.jpg',
    '/assets/images/gallery/8.jpg',
    '/assets/images/gallery/9.jpg',
    '/assets/images/gallery/10.jpg',
    '/assets/images/gallery/11.jpg',
    '/assets/images/gallery/12.jpg',
    '/assets/images/gallery/13.jpg',
    '/assets/images/gallery/14.jpg',
    '/assets/images/gallery/16.jpg',
];
const galleryImages2 = [
    '/assets/images/gallery/17.jpg',
    '/assets/images/gallery/18.jpg',
    '/assets/images/gallery/19.jpg',
    '/assets/images/gallery/20.jpg',
    '/assets/images/gallery/21.jpg',
    '/assets/images/gallery/22.jpg',
    '/assets/images/gallery/23.jpg',
    '/assets/images/gallery/24.jpg',
    '/assets/images/gallery/25.jpg',
    '/assets/images/gallery/26.jpg',
    '/assets/images/gallery/27.jpg',
    '/assets/images/gallery/28.jpg',
    '/assets/images/gallery/29.jpg',
    '/assets/images/gallery/30.jpg',
    '/assets/images/gallery/31.jpg',
];
const imageHeight = 240; // px (4:3 ratio for width 320px)
const totalImages = galleryImages1.length * 2; // duplicado para loop
</script>

<template>
    <div
        class="relative flex h-full max-h-screen flex-row items-center justify-center overflow-hidden rounded-2xl bg-transparent"
        style="width: 640px"
    >
        <!-- Columna 1: de arriba hacia abajo -->
        <div class="animate-vertical-tape flex flex-col" :style="{ height: `${imageHeight * totalImages}px`, width: '320px' }">
            <div
                v-for="(img, idx) in [...galleryImages1, ...galleryImages1]"
                :key="'col1-' + img + idx"
                class="flex w-full items-center justify-center"
                :style="{ height: imageHeight + 'px', width: '320px' }"
            >
                <img :src="img" class="h-full w-full rounded-none object-cover" alt="Foto Reencuentro" style="aspect-ratio: 4/3" />
            </div>
        </div>
        <!-- Columna 2: de abajo hacia arriba -->
        <div class="animate-vertical-tape-reverse flex flex-col" :style="{ height: `${imageHeight * totalImages}px`, width: '320px' }">
            <div
                v-for="(img, idx) in [...galleryImages2, ...galleryImages2]"
                :key="'col2-' + img + idx"
                class="flex w-full items-center justify-center"
                :style="{ height: imageHeight + 'px', width: '320px' }"
            >
                <img :src="img" class="h-full w-full rounded-none object-cover" alt="Foto Reencuentro" style="aspect-ratio: 4/3" />
            </div>
        </div>
    </div>
</template>

<style scoped>
@keyframes vertical-tape {
    0% {
        transform: translateY(0);
    }
    100% {
        transform: translateY(-1800px);
    }
}
@keyframes vertical-tape-reverse {
    0% {
        transform: translateY(-1800px);
    }
    100% {
        transform: translateY(0);
    }
}
.animate-vertical-tape {
    animation: vertical-tape 30s linear infinite;
}
.animate-vertical-tape-reverse {
    animation: vertical-tape-reverse 30s linear infinite;
}
</style>
