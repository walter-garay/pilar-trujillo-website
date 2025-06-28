<script setup lang="ts">
import type { Sponsor } from '@/types';

interface Props {
    sponsors?: Sponsor[];
    phone?: string;
}

const { sponsors, phone } = defineProps<Props>();

console.log('spnosr: ', sponsors);
// Generar enlaces de WhatsApp dinámicamente
const getWhatsAppLink = (message: string) => {
    if (!phone) return '#';
    const cleanPhone = phone.replace(/\D/g, ''); // Remover caracteres no numéricos
    const encodedMessage = encodeURIComponent(message);
    return `https://api.whatsapp.com/send?phone=${cleanPhone}&text=${encodedMessage}`;
};

const collaborationLink = getWhatsAppLink(
    'Hola, Pilar, mucho gusto!\n\nVi tu trabajo y me encanta. Me gustaría poder trabajar contigo en forma de *colaborador*. 💌',
);

const donationLink = getWhatsAppLink(
    'Hola, Pilar, mucho gusto!\n\nVi tu trabajo y me encanta. Me gustaría poder colaborar contigo en forma de *donación*. 💌',
);
</script>

<template>
    <section class="bg-background py-20">
        <div class="mx-auto max-w-5xl px-4">
            <!-- Section Header -->
            <div class="mb-12 text-center">
                <h2 class="text-3xl font-extrabold text-primary md:text-4xl">Colaboradores</h2>
                <p class="mx-auto mt-4 max-w-2xl text-lg text-muted-foreground">
                    Colaboramos con organizaciones que comparten nuestra visión de un periodismo independiente, veraz y comprometido con la sociedad.
                </p>
            </div>

            <!-- Sponsors Grid -->
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                <UCard
                    v-for="sponsor in sponsors"
                    :key="sponsor.id"
                    class="overflow-hidden bg-card text-center transition-transform duration-300 ease-in-out hover:-translate-y-2"
                >
                    <div class="mb-4 flex aspect-video w-full items-center justify-center rounded-md bg-white p-4">
                        <img :src="sponsor.logo_url" :alt="sponsor.name" class="max-h-full max-w-full rounded-md object-contain" />
                    </div>
                    <h3 class="text-lg font-bold text-foreground">{{ sponsor.name }}</h3>
                    <p class="mt-1 text-sm text-muted-foreground">{{ sponsor.description }}</p>

                    <template #footer>
                        <a
                            :href="sponsor.website_url || ''"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="flex items-center justify-center gap-2 text-sm font-semibold text-primary transition-colors hover:text-primary/80"
                        >
                            Visitar sitio web
                            <UIcon name="i-lucide-arrow-up-right" class="h-4 w-4" />
                        </a>
                    </template>
                </UCard>
            </div>

            <!-- CTA Banner -->
            <div class="mt-16 rounded-2xl bg-primary p-8 text-center text-primary-foreground md:p-12">
                <h3 class="text-3xl font-bold">¿Interesado en colaborar?</h3>
                <p class="mx-auto mt-4 max-w-xl text-lg text-primary-foreground/90">
                    Si tú o tu organización comparte nuestros valores y desea formar parte de mis proyectos, me encantaría conocerte.
                </p>
                <div class="mt-8 flex flex-col justify-center gap-4 sm:flex-row">
                    <UButton :to="donationLink" target="_blank" variant="outline" size="lg" class="border-1 border-white text-white hover:bg-white/10"
                        >Donar</UButton
                    >
                    <UButton :to="collaborationLink" target="_blank" size="lg" class="bg-white text-primary hover:bg-white/90"
                        >Ser colaborador</UButton
                    >
                </div>
            </div>
        </div>
    </section>
</template>
