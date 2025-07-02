<script setup lang="ts">
import Navbar from '@/pages/landing/components/Navbar.vue';
import Footer from '@/pages/landing/sections/Footer.vue';
import { onBeforeUnmount, onMounted, ref } from 'vue';

// Galería estática de imágenes tipo masonry

// Lista de imágenes de la carpeta /assets/images/gallery
const galleryImages = [
    '1.jpg',
    '2.jpg',
    '3.jpg',
    '4.jpg',
    '5.jpg',
    '6.jpg',
    '7.jpg',
    '8.jpg',
    '9.jpg',
    '10.jpg',
    '11.jpg',
    '12.jpg',
    '13.jpg',
    '14.jpg',
    '16.jpg',
    '17.jpg',
    '18.jpg',
    '19.jpg',
    '20.jpg',
    '21.jpg',
    '22.jpg',
    '23.jpg',
    '24.jpg',
    '25.jpg',
    '26.jpg',
    '27.jpg',
    '28.jpg',
    '29.jpg',
    '30.jpg',
    '31.jpg',
    '32.jpg',
    '33.jpg',
    '34.jpg',
    '35.jpg',
    '36.jpg',
    '37.jpg',
    '38.jpg',
    '39.jpg',
    '40.jpg',
    '41.jpg',
    '42.jpg',
    '43.jpg',
    '44.jpg',
    '45.jpg',
    '46.jpg',
    '47.jpg',
    '48.jpg',
    '49.jpg',
    '50.jpg',
    '51.jpg',
    '52.jpg',
    '53.jpg',
    '54.jpg',
    '55.jpg',
    '56.jpg',
    '57.jpg',
    '58.jpg',
    '59.jpg',
    '60.jpg',
    '61.jpg',
    '62.jpg',
    '63.jpg',
    '64.jpg',
    '65.jpg',
    '66.jpg',
    '67.jpg',
    '68.jpeg',
    '69.jpg',
    '70.jpg',
    '71.jpg',
    '72.jpg',
    '73.jpg',
    '74.jpg',
    '75.jpg',
    '76.jpg',
    '77.jpg',
].map((img) => `/assets/images/gallery/${img}`);

const lightboxOpen = ref(false);
const lightboxImg = ref('');
const visibleImages = ref<boolean[]>(galleryImages.map(() => false));
const observers: IntersectionObserver[] = [];

function openLightbox(img: string) {
    lightboxImg.value = img;
    lightboxOpen.value = true;
}
function closeLightbox() {
    lightboxOpen.value = false;
    lightboxImg.value = '';
}

onMounted(() => {
    galleryImages.forEach((_, i) => {
        const el = document.getElementById(`gallery-img-${i}`);
        if (el) {
            const observer = new window.IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            visibleImages.value[i] = true;
                            observer.disconnect();
                        }
                    });
                },
                { rootMargin: '200px' },
            );
            observer.observe(el);
            observers.push(observer);
        }
    });
});

onBeforeUnmount(() => {
    observers.forEach((observer) => observer.disconnect());
});
</script>

<template>
    <Navbar />
    <section class="gallery-section">
        <h1 class="gallery-title">Galería de Fotos</h1>
        <div class="gallery-flex">
            <div
                v-for="(img, i) in galleryImages"
                :key="i"
                :id="`gallery-img-${i}`"
                style="min-width: 200px; min-height: 120px; display: flex; align-items: center; justify-content: center"
            >
                <img
                    v-if="visibleImages[i]"
                    :src="img"
                    :alt="`Foto de galería ${i + 1}`"
                    loading="lazy"
                    class="gallery-img"
                    @click="openLightbox(img)"
                    style="cursor: pointer"
                />
            </div>
        </div>
        <div v-if="lightboxOpen" class="lightbox" @click.self="closeLightbox">
            <button class="lightbox-close" @click="closeLightbox" aria-label="Cerrar">&times;</button>
            <img :src="lightboxImg" class="lightbox-img" alt="Imagen ampliada" />
        </div>
    </section>
    <Footer />
</template>

<style scoped>
.gallery-section {
    padding: 2rem 1rem;
    max-width: 1400px;
    margin: 0 auto;
}
.gallery-title {
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 2rem;
    text-align: center;
}
.gallery-flex {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    justify-content: center;
    align-items: flex-start;
}
.gallery-img {
    display: block;
    height: auto;
    max-width: 100%;
    max-height: 420px;
    border-radius: 10px;
    box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.07);
    background: #fff;
    transition: transform 0.2s;
}
.gallery-img:hover {
    transform: scale(1.03);
    box-shadow: 0 4px 16px 0 rgba(0, 0, 0, 0.15);
}
.lightbox {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.85);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: fadeIn 0.2s;
}
.lightbox-img {
    max-width: 90vw;
    max-height: 90vh;
    border-radius: 12px;
    box-shadow: 0 4px 32px 0 rgba(0, 0, 0, 0.25);
}
.lightbox-close {
    position: absolute;
    top: 32px;
    right: 48px;
    font-size: 2.5rem;
    color: #fff;
    background: none;
    border: none;
    cursor: pointer;
    z-index: 1010;
    transition: color 0.2s;
}
.lightbox-close:hover {
    color: #fcc633;
}
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
</style>
