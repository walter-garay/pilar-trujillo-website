<script setup lang="ts">
import { ref } from 'vue';

const isMuted = ref(true);
const toggleMute = () => {
    const video = document.getElementById('presentation-video') as HTMLVideoElement | null;
    if (video) {
        video.muted = !video.muted;
        isMuted.value = video.muted;
    }
};
</script>
<template>
    <section id="program-presentation" class="relative flex h-screen w-full items-center justify-center overflow-hidden">
        <!-- Fade superior -->
        <div
            class="pointer-events-none absolute top-0 left-0 z-20 h-24 w-full"
            style="background: linear-gradient(to bottom, var(--background), transparent)"
        ></div>
        <!-- Fade inferior -->
        <div
            class="pointer-events-none absolute bottom-0 left-0 z-20 h-24 w-full"
            style="background: linear-gradient(to top, var(--background), transparent)"
        ></div>
        <!-- Background Video -->
        <video id="presentation-video" autoplay loop muted class="absolute top-0 left-0 h-full w-full object-cover">
            <source src="/assets/videos/reencuentro_presentation.mp4" type="video/mp4" />
            Tu navegador no soporta la etiqueta de video.
        </video>
        <!-- Overlay suave -->
        <div class="absolute top-0 left-0 z-10 h-full w-full bg-black/40"></div>
        <!-- Botón mute -->
        <button @click="toggleMute" class="absolute top-4 right-4 z-30 rounded-full bg-black/60 p-2 transition-colors hover:bg-black/80">
            <UIcon :name="isMuted ? 'i-heroicons-speaker-x-mark-20-solid' : 'i-heroicons-speaker-wave-20-solid'" class="h-7 w-7 text-white" />
        </button>
        <!-- Overlay Content -->
        <div class="relative z-20 flex flex-col items-center justify-center p-4 text-center text-white">
            <img src="/assets/images/brand/isotipo.png" alt="Reencuentro" class="mb-6 h-32 w-32 object-contain" />
            <h1 class="text-6xl leading-tight font-black drop-shadow-lg">Reencuentro</h1>
            <p class="mt-4 max-w-2xl text-xl drop-shadow">
                Un programa que explora las historias humanas de reconciliación, perdón y segundas oportunidades.
            </p>
            <div class="mt-6 flex flex-col items-center gap-4">
                <UBadge color="neutral" variant="solid" size="lg">Sábados y domingos de 7PM a 8PM</UBadge>
                <UButton color="primary" size="lg" to="/multimedia/television">Ver último programa</UButton>
            </div>
        </div>
    </section>
</template>
