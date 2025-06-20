<script setup lang="ts">
import Navbar from './components/Navbar.vue';
import AboutAndCareer from './sections/AboutAndCareer.vue';
import Hero from './sections/Hero.vue';
import MediasOverview from './sections/MediasOverview.vue';
import ProgramPresentation from './sections/ProgramPresentation.vue';
</script>

<template>
    <div class="flex min-h-screen flex-col bg-background">
        <Navbar />
        <main>
            <Hero />
            <ProgramPresentation />
            <AboutAndCareer />
            <MediasOverview />
        </main>
    </div>
</template>
