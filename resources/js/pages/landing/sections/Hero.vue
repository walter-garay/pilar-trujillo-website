<script setup lang="ts">
// Header hero puro, sin tarjeta

interface Props {
    socialMediaUrls?: Record<string, string>;
}

const { socialMediaUrls } = defineProps<Props>();

const scrollToVideo = () => {
    const el = document.getElementById('program-presentation');
    if (el) {
        el.scrollIntoView({ behavior: 'smooth' });
    }
};
</script>

<template>
    <section
        class="relative flex min-h-screen w-full items-center justify-center bg-gradient-to-b from-purple-100 to-background dark:from-purple-900 dark:to-background"
    >
        <UContainer class="flex w-full flex-col gap-16 md:flex-row">
            <!-- Columna izquierda -->
            <div class="flex flex-1 flex-col justify-center gap-6">
                <div>
                    <h1 class="text-5xl leading-tight font-black">Pilar <span class="text-primary">Trujillo Martel</span></h1>
                    <p class="mt-4 max-w-xl text-xl text-foreground/80">
                        Periodista Huanuqueña comprometida con la verdad, conectando historias que transforman y construyen puentes en nuestra
                        sociedad.
                    </p>
                </div>
                <div class="mt-2 flex gap-6">
                    <ULink
                        v-if="socialMediaUrls?.facebook"
                        :to="socialMediaUrls.facebook"
                        target="_blank"
                        aria-label="Facebook"
                        class="text-foreground/80 transition-colors hover:text-primary"
                    >
                        <UIcon name="i-cib-facebook" class="h-6 w-6" />
                    </ULink>
                    <ULink
                        v-if="socialMediaUrls?.instagram"
                        :to="socialMediaUrls.instagram"
                        target="_blank"
                        aria-label="Instagram"
                        class="text-foreground/80 transition-colors hover:text-primary"
                    >
                        <UIcon name="i-cib-instagram" class="h-6 w-6" />
                    </ULink>
                    <ULink
                        v-if="socialMediaUrls?.tiktok"
                        :to="socialMediaUrls.tiktok"
                        target="_blank"
                        aria-label="TikTok"
                        class="text-foreground/80 transition-colors hover:text-primary"
                    >
                        <UIcon name="i-cib-tiktok" class="h-6 w-6" />
                    </ULink>
                    <ULink
                        v-if="socialMediaUrls?.youtube"
                        :to="socialMediaUrls.youtube"
                        target="_blank"
                        aria-label="YouTube"
                        class="text-foreground/80 transition-colors hover:text-primary"
                    >
                        <UIcon name="i-cib-youtube" class="h-6 w-6" />
                    </ULink>
                </div>
                <div class="mt-6 flex gap-4">
                    <UButton color="primary" size="lg" class="px-8" @click="scrollToVideo">Ver Reencuentro</UButton>
                    <UButton color="primary" size="lg" variant="outline" class="px-8" to="#">Conocer más</UButton>
                </div>
                <div class="mt-8 flex gap-10">
                    <div class="flex flex-col items-center gap-2 text-center">
                        <div class="flex items-center gap-2">
                            <UIcon name="i-heroicons-trophy" class="h-8 w-8 text-primary" />
                            <span class="text-2xl font-bold text-foreground">15+</span>
                        </div>
                        <span class="text-sm text-foreground/60">Premios de Periodismo</span>
                    </div>
                    <div class="flex flex-col items-center gap-2 text-center">
                        <div class="flex items-center gap-2">
                            <UIcon name="i-heroicons-calendar-days" class="h-8 w-8 text-primary" />
                            <span class="text-2xl font-bold text-foreground">20</span>
                        </div>
                        <span class="text-sm text-foreground/60">Años de Experiencia</span>
                    </div>
                    <div class="flex flex-col items-center gap-2 text-center">
                        <div class="flex items-center gap-2">
                            <UIcon name="i-heroicons-microphone" class="h-8 w-8 text-primary" />
                            <span class="text-2xl font-bold text-foreground">500+</span>
                        </div>
                        <span class="text-sm text-foreground/60">Entrevistas Realizadas</span>
                    </div>
                </div>
            </div>
        </UContainer>
        <!-- Imagen PNG de la persona, centrada abajo -->
        <img
            src="/assets/woman.png"
            alt="Pilar Trujillo Martel"
            class="pointer-events-none absolute bottom-0 left-1/2 z-20 h-auto w-auto max-w-xs translate-x-20 select-none md:max-w-md lg:max-w-lg"
            draggable="false"
        />
    </section>
</template>
