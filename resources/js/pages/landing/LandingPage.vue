<script setup lang="ts">
import type { Media, Sponsor, User } from '@/types';
import Navbar from './components/Navbar.vue';
import AboutAndCareer from './sections/AboutAndCareer.vue';
import Footer from './sections/Footer.vue';
import Hero from './sections/Hero.vue';
import MediasOverview from './sections/MediasOverview.vue';
import ProgramPresentation from './sections/ProgramPresentation.vue';
import Sponsors from './sections/Sponsors.vue';

const props = defineProps({
    medias: Object as () => Record<string, Media[]>,
    sponsors: Array as () => Sponsor[],
    adminUser: Object as () => User,
});

console.log('sponsors: ', props.sponsors);
</script>

<template>
    <div class="flex min-h-screen flex-col bg-background">
        <Navbar />
        <main>
            <Hero :social-media-urls="adminUser?.social_media_urls" />
            <ProgramPresentation />
            <AboutAndCareer />
            <MediasOverview :medias="props.medias" />
            <Sponsors :sponsors="props.sponsors" :phone="adminUser?.phone" />
        </main>
        <Footer :email="adminUser?.email" :phone="adminUser?.phone" :social-media-urls="adminUser?.social_media_urls" />
    </div>
</template>
