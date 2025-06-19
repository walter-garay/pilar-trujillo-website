<template>
    <div class="flex flex-col items-center justify-between gap-8 py-12 md:flex-row">
        <!-- Columna izquierda -->
        <div class="flex flex-1 flex-col gap-6">
            <div>
                <h1 class="text-5xl leading-tight font-black">Pilar <span class="text-primary">Trujillo</span></h1>
                <p class="mt-4 max-w-xl text-xl text-gray-700">
                    Periodista comprometida con la verdad, conectando historias que transforman y construyen puentes en nuestra sociedad.
                </p>
            </div>
            <div class="mt-2 flex gap-4">
                <UButton icon="i-simple-icons-facebook" color="primary" variant="soft" to="#" aria-label="Facebook" />
                <UButton icon="i-simple-icons-instagram" color="primary" variant="soft" to="#" aria-label="Instagram" />
                <UButton icon="i-simple-icons-tiktok" color="primary" variant="soft" to="#" aria-label="TikTok" />
            </div>
            <div class="mt-6 flex gap-4">
                <UButton color="primary" size="lg" class="px-8" to="#">Ver Reencuentro</UButton>
                <UButton color="primary" size="lg" variant="outline" class="px-8" to="#">Conocer más</UButton>
            </div>
            <div class="mt-8 flex gap-10">
                <div class="flex flex-col items-center">
                    <span class="text-2xl font-bold text-primary">15+</span>
                    <span class="text-sm text-gray-600">Premios de Periodismo</span>
                </div>
                <div class="flex flex-col items-center">
                    <span class="text-2xl font-bold text-primary">20</span>
                    <span class="text-sm text-gray-600">Años de Experiencia</span>
                </div>
                <div class="flex flex-col items-center">
                    <span class="text-2xl font-bold text-primary">500+</span>
                    <span class="text-sm text-gray-600">Entrevistas Realizadas</span>
                </div>
            </div>
        </div>
        <!-- Columna derecha: Imagen fija -->
        <div class="flex-shrink-0">
            <img
                src="https://images.pexels.com/photos/1181696/pexels-photo-1181696.jpeg?auto=compress&w=320&h=320&fit=facearea"
                alt="Pilar Trujillo"
                class="h-72 w-72 rounded-full border-4 border-white object-cover shadow-2xl"
            />
        </div>
    </div>
</template>

<script setup lang="ts">
// Header estático, imagen fija
</script>
