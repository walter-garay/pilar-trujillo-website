<script setup lang="ts">
// Sección Sobre mí y Reencuentro con NuxtUI y placeholders
</script>

<template>
    <section
        class="relative flex min-h-screen w-full items-center justify-center bg-gradient-to-b from-background to-purple-50 py-16 dark:to-purple-950"
    >
        <UContainer class="flex w-full flex-col gap-12 md:flex-row">
            <!-- Columna 1: Sobre mí -->
            <UCard class="flex flex-1 flex-col items-center justify-center gap-6 bg-background/80 shadow-xl md:items-start">
                <div class="mb-2 flex items-center gap-4">
                    <UAvatar src="https://randomuser.me/api/portraits/women/44.jpg" size="xl" alt="Pilar Trujillo" />
                    <div>
                        <h2 class="text-3xl font-bold text-primary">Pilar Trujillo</h2>
                        <UBadge color="primary" variant="soft">Periodista</UBadge>
                    </div>
                </div>
                <div class="mb-2 flex flex-wrap gap-2">
                    <UAvatar src="https://randomuser.me/api/portraits/women/45.jpg" size="md" alt="Pilar joven" />
                    <UAvatar src="https://randomuser.me/api/portraits/women/46.jpg" size="md" alt="Pilar reportera" />
                    <UAvatar src="https://randomuser.me/api/portraits/women/47.jpg" size="md" alt="Pilar en evento" />
                </div>
                <p class="max-w-xl text-lg text-foreground/80">
                    Soy una periodista huanuqueña apasionada por contar historias que inspiran y transforman. Con más de 20 años de experiencia, he
                    recibido múltiples premios de periodismo y soy reconocida por mi compromiso con la verdad y la reconciliación social.
                </p>
                <div class="mt-2 flex gap-4">
                    <UBadge color="primary" variant="outline">15+ Premios</UBadge>
                    <UBadge color="primary" variant="outline">500+ Entrevistas</UBadge>
                    <UBadge color="primary" variant="outline">20 años</UBadge>
                </div>
            </UCard>
            <!-- Columna 2: Reencuentro -->
            <UCard class="flex flex-1 flex-col items-center justify-center gap-6 bg-background/80 shadow-xl md:items-start">
                <div class="mb-2 flex items-center gap-4">
                    <UAvatar
                        src="https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?auto=format&fit=facearea&w=128&q=80"
                        size="xl"
                        alt="Reencuentro"
                    />
                    <div>
                        <h2 class="text-3xl font-bold text-primary">Reencuentro</h2>
                        <UBadge color="primary" variant="soft">Programa Estelar</UBadge>
                    </div>
                </div>
                <div class="mb-2 flex flex-wrap gap-2">
                    <UAvatar
                        src="https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?auto=format&fit=facearea&w=128&q=80"
                        size="md"
                        alt="Set TV"
                    />
                    <UAvatar
                        src="https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=facearea&w=128&q=80"
                        size="md"
                        alt="Entrevista"
                    />
                    <UAvatar
                        src="https://images.unsplash.com/photo-1519125323398-675f0ddb6308?auto=format&fit=facearea&w=128&q=80"
                        size="md"
                        alt="Producción"
                    />
                </div>
                <p class="max-w-xl text-lg text-foreground/80">
                    "Reencuentro" es mi programa estelar, donde exploro historias humanas de reconciliación, perdón y segundas oportunidades. Además,
                    he trabajado en otros proyectos audiovisuales y documentales sobre temas sociales y culturales.
                </p>
                <div class="mt-2 flex gap-4">
                    <UBadge color="primary" variant="outline">3 Temporadas</UBadge>
                    <UBadge color="primary" variant="outline">+10 Proyectos</UBadge>
                    <UBadge color="primary" variant="outline">Premio Social 2023</UBadge>
                </div>
            </UCard>
        </UContainer>
    </section>
</template>
