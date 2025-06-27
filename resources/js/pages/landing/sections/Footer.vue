<script setup lang="ts">
interface Props {
    email?: string;
    phone?: string;
    socialMediaUrls?: Record<string, string>;
}

const { email, phone, socialMediaUrls } = defineProps<Props>();

const quickLinks = [
    { text: 'Sobre Mí', href: '#' },
    { text: 'Reencuentro', href: '#' },
    { text: 'Multimedia', href: '/multimedia' },
    { text: 'Sponsors', href: '#' },
    { text: 'Publicaciones', href: '/publicacions' },
    { text: 'Colaboraciones', href: '#' },
];

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
    <footer class="border-t bg-background">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-4">
                <!-- About Section -->
                <div class="lg:col-span-1">
                    <div class="flex items-center gap-3">
                        <UAvatar size="md" src="/assets/woman.png" alt="Pilar Trujillo" />
                        <span class="text-xl font-bold text-foreground">Pilar Trujillo</span>
                    </div>
                    <p class="mt-4 text-sm text-muted-foreground">
                        Periodista comprometida con la verdad, la justicia social y la construcción de puentes entre las personas a través de
                        historias que transforman.
                    </p>
                    <div class="mt-6 flex gap-3">
                        <UButton
                            v-if="socialMediaUrls?.facebook"
                            :to="socialMediaUrls.facebook"
                            target="_blank"
                            icon="i-lucide-facebook"
                            color="neutral"
                            variant="ghost"
                            size="lg"
                            class="rounded-full text-muted-foreground hover:text-foreground"
                        />
                        <UButton
                            v-if="socialMediaUrls?.instagram"
                            :to="socialMediaUrls.instagram"
                            target="_blank"
                            icon="i-lucide-instagram"
                            color="neutral"
                            variant="ghost"
                            size="lg"
                            class="rounded-full text-muted-foreground hover:text-foreground"
                        />
                        <UButton
                            v-if="socialMediaUrls?.tiktok"
                            :to="socialMediaUrls.tiktok"
                            target="_blank"
                            icon="meteor-icons:tiktok"
                            color="neutral"
                            variant="ghost"
                            size="lg"
                            class="rounded-full text-muted-foreground hover:text-foreground"
                        />
                        <UButton
                            v-if="socialMediaUrls?.youtube"
                            :to="socialMediaUrls.youtube"
                            target="_blank"
                            icon="i-lucide-youtube"
                            color="neutral"
                            variant="ghost"
                            size="lg"
                            class="rounded-full text-muted-foreground hover:text-foreground"
                        />
                    </div>
                </div>

                <!-- Links Section -->
                <div class="grid grid-cols-2 gap-8 sm:grid-cols-3 lg:col-span-3 lg:grid-cols-3">
                    <div>
                        <h3 class="font-semibold text-foreground">Enlaces Rápidos</h3>
                        <ul class="mt-4 space-y-2">
                            <li v-for="link in quickLinks" :key="link.text">
                                <ULink :to="link.href" class="text-sm text-muted-foreground transition hover:text-foreground">{{ link.text }}</ULink>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-semibold text-foreground">Contacto</h3>
                        <ul class="mt-4 space-y-3">
                            <li class="flex items-start gap-3">
                                <UIcon name="i-lucide-mail" class="mt-1 h-5 w-5 flex-shrink-0 text-muted-foreground" />
                                <div>
                                    <span class="text-sm text-foreground">{{ email }}</span>
                                    <p class="text-xs text-muted-foreground">Prensa y colaboraciones</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <UIcon name="i-lucide-phone" class="mt-1 h-5 w-5 flex-shrink-0 text-muted-foreground" />
                                <div>
                                    <span class="text-sm text-foreground">{{ phone }}</span>
                                    <p class="text-xs text-muted-foreground">Lunes a viernes, 9-18h</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <UIcon name="i-lucide-map-pin" class="mt-1 h-5 w-5 flex-shrink-0 text-muted-foreground" />
                                <div>
                                    <span class="text-sm text-foreground">Ciudad de Huánuco, Perú</span>
                                    <p class="text-xs text-muted-foreground">Oficina principal</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-semibold text-foreground">Colaborador</h3>
                        <p class="mt-4 text-sm text-muted-foreground">Apoya el periodismo independiente y ayúdame a contar más historias.</p>
                        <div class="mt-4 flex flex-col gap-3">
                            <UButton
                                :to="collaborationLink"
                                target="_blank"
                                size="md"
                                class="flex justify-center bg-primary text-primary-foreground hover:bg-primary/90"
                                >Ser colaborador</UButton
                            >
                            <UButton
                                :to="donationLink"
                                target="_blank"
                                variant="subtle"
                                size="md"
                                class="flex justify-center border-primary font-bold text-primary hover:bg-primary/10"
                                >Donar</UButton
                            >
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="mt-12 border-t border-gray-200 pt-8 dark:border-gray-800">
                <div class="sm:flex sm:items-center sm:justify-between">
                    <div class="flex gap-4">
                        <ULink to="#" class="text-xs text-muted-foreground hover:text-foreground">Política de Privacidad</ULink>
                        <ULink to="#" class="text-xs text-muted-foreground hover:text-foreground">Términos de Uso</ULink>
                        <ULink to="#" class="text-xs text-muted-foreground hover:text-foreground">Cookies</ULink>
                    </div>
                    <p class="mt-4 text-xs text-muted-foreground sm:mt-0">
                        &copy; {{ new Date().getFullYear() }} Pilar Trujillo. Todos los derechos reservados.
                    </p>
                </div>
            </div>
        </div>
    </footer>
</template>
