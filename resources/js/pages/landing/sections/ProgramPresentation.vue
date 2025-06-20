<script setup lang="ts"></script>
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
        <video autoplay loop class="absolute top-0 left-0 h-full w-full object-cover">
            <source src="/assets/video.mp4" type="video/mp4" />
            Tu navegador no soporta la etiqueta de video.
        </video>
        <!-- Overlay suave -->
        <div class="absolute top-0 left-0 z-10 h-full w-full bg-black/40"></div>
        <!-- Overlay Content -->
        <div class="relative z-20 flex flex-col items-center justify-center p-4 text-center text-white">
            <h1 class="text-6xl leading-tight font-black drop-shadow-lg">Reencuentro</h1>
            <p class="mt-4 max-w-2xl text-xl drop-shadow">
                Un programa que explora las historias humanas de reconciliación, perdón y segundas oportunidades.
            </p>
            <div class="mt-6 flex justify-center gap-4">
                <UBadge color="neutral" variant="solid" size="lg">Domingos 8:00 PM</UBadge>
                <UBadge color="neutral" variant="solid" size="lg">1 hora</UBadge>
            </div>
        </div>
    </section>
</template>
