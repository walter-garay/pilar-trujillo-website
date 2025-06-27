<script setup lang="ts">
import Navbar from '@/pages/landing/components/Navbar.vue';
import Footer from '@/pages/landing/sections/Footer.vue';
import type { Category, Publication } from '@/types';
import { Head } from '@inertiajs/vue3';
import PublicationsList from './components/PublicationsList.vue';

interface Props {
    publications: Publication[];
    categories: Category[];
}

defineProps<Props>();
</script>

<template>
    <Head title="Catálogo de Publicaciones" />

    <div class="min-h-screen bg-muted/30">
        <!-- Navbar -->
        <Navbar />

        <!-- Header con título -->
        <div class="border-b border-border bg-card pt-16">
            <div class="container mx-auto px-4 py-12">
                <div class="space-y-4 text-center">
                    <h1 class="text-4xl font-bold text-primary">Catálogo de Publicaciones</h1>
                    <p class="mx-auto max-w-2xl text-lg text-muted-foreground">
                        Descubre artículos, ensayos y reflexiones sobre cultura, arte y sociedad que inspiran y transforman nuestra visión del mundo
                    </p>
                </div>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="container mx-auto px-4 py-8">
            <PublicationsList :publications="publications" />
        </div>

        <!-- Footer -->
        <Footer />
    </div>
</template>
