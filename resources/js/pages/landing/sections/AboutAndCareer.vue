<script setup lang="ts">
import { ref } from 'vue';

const expanded = ref(false);
const expanded2 = ref(false);
</script>

<template>
    <section class="relative flex min-h-screen w-full items-center justify-center bg-background py-16">
        <UContainer class="flex w-full flex-col gap-12">
            <!-- Fila 1: Biografía de Pilar Trujillo -->
            <UCard class="flex w-full flex-col items-center justify-center gap-6 bg-card p-8 shadow-xl">
                <!-- Galería de fotos de Pilar -->
                <div class="relative mb-4 flex w-full items-end justify-center">
                    <img src="/assets/images/pilar/banner.jpg" alt="Banner Pilar Trujillo" class="max-h-64 w-full rounded-xl object-cover shadow" />
                    <div
                        class="absolute bottom-0 left-0 h-20 w-full rounded-b-xl"
                        style="background: linear-gradient(to top, var(--background), transparent)"
                    ></div>
                </div>
                <h2 class="mt-8 text-center text-2xl font-extrabold text-cyan-600 md:text-3xl">Hortensia del Pilar Trujillo Martel</h2>
                <p class="mb-8 text-center text-base font-bold text-green-600 md:text-xl">Comunicadora cultural por naturaleza</p>
                <div
                    class="relative mx-auto grid w-full max-w-5xl grid-cols-1 gap-8 text-justify text-sm leading-relaxed text-foreground/90 md:grid-cols-2 md:text-base"
                    :class="expanded ? '' : 'max-h-64 overflow-hidden'"
                >
                    <div
                        v-if="!expanded"
                        class="pointer-events-none absolute bottom-0 left-0 h-16 w-full bg-gradient-to-t from-background/90 to-transparent"
                    ></div>
                    <div class="space-y-4">
                        <p>
                            Hortensia del Pilar Trujillo Martel, nació en la cálida ciudad de Huánuco el 29 de marzo de 1966. El amor por Huánuco, la
                            cultura y la radiodifusión, marcan la pauta en su vida. El primer atisbo sería el periódico mural a su cargo en el Colegio
                            María Auxiliadora de nuestra ciudad.
                        </p>
                        <img
                            src="/assets/images/pilar/1.jpg"
                            alt="Pilar con Yoshio Onuki y Thatsuhiko Fujii"
                            class="mx-auto my-2 w-full rounded-xl object-cover shadow"
                        />
                        <p>
                            En 1985, casi al culminar la carrera de Guía Oficial de Turismo en el Instituto Superior Tecnológico Aparicio Pomares,
                            asumió como vital la tarea de fomentar la trascendencia cultural y socioeconómica del turismo, por ello se capacitó en
                            producción de programas de televisión en el Instituto Nacional de Investigación y Capacitación en Telecomunicaciones
                            INICTEL de Lima.
                        </p>
                        <p>
                            Definió también, como baluarte de su trabajo comunicacional, la investigación, al iniciar los estudios sobre las Lagunas
                            de Pichgacocha para su difusión. Y, entre los años 1989-1990 sería responsable del segmento cultural en el noticiero de
                            radio Studio 5. Esta vertiente, se acrisolaría laborando en el área de publicidad del suplemento El Dominical de El
                            Comercio, entre los años 1993-1997, al crear productos periodísticos semanalmente, y escribir algunos artículos sobre
                            Huánuco.
                        </p>
                        <p>
                            Destacado rol asume en esta dimensión, su participación durante los años 1998-2000 en cuatro guías turísticas de la serie
                            Todo: Todo Arequipa, Todo Lima, Todo Perú y Todo Machu Picchu, producidas por Editorial Escudo de Oro (España) y Tierra
                            Firme Ediciones (Perú).
                        </p>
                        <p>
                            Dos documentales referidos a la Congregación de las Hijas de María Auxiliadora (2007-2008), se registran en este contexto,
                            al igual que la historia de la sagrada imagen del Señor de Burgos de Huánuco (2015).
                        </p>
                        <img src="/assets/images/pilar/2.jpg" alt="Pilar 2" class="mx-auto my-2 w-full rounded-xl object-cover shadow" />
                    </div>
                    <div class="space-y-4">
                        <p>
                            Asumió su desempeño profesional en Ciencias de la Comunicación Social en la esfera cultural. Su propuesta concreta es
                            REENCUENTRO, que significa volver a encontrarse con el pasado, con las raíces. El objetivo es fortalecer el amor por lo
                            nuestro.
                        </p>
                        <p>
                            Reingresaría al fascinante mundo de la radio en el año 2005, primero con ediciones especiales en Studio 5, formalmente
                            desde el 2007 hasta el 2012. Luego en Ondas del Huallaga, posteriormente en radio La Cabaña y, finalmente, en radio
                            UNEHVAL.
                        </p>
                        <p>
                            Su misión se extendería en la prensa escrita a través de los diarios El Espectador, Antorcha, Ahora, Página3 y en la
                            Revista Papiro. Su impensada inserción en la televisión con REENCUENTRO en su condición de directora y conductora, tendría
                            lugar hace 13 años en Cable Visión Huánuco Canal 21, hoy en CTV Continental Televisión Canal 25 UHF ubicándose como uno de
                            los de mayor sintonía dentro de su programación.
                        </p>
                        <img
                            src="/assets/images/pilar/6.jpg"
                            alt="Pilar reportera"
                            class="mx-auto my-2 w-full rounded-xl object-cover shadow md:w-full"
                        />
                        <p>
                            Esta realidad profesional –creativa, ética y comprometida– ha contribuido a fomentar y fortalecer la valoración por
                            nuestro patrimonio material e inmaterial regional. Por otra parte, ha motivado el asumir la cultura como un camino hacia
                            la realización profesional en un segmento de jóvenes generaciones de comunicadores sociales.
                        </p>
                        <p>
                            Su transitar por las aulas del nivel secundaria en el colegio de las Dominicas de Huánuco y, luego, en las universitarias
                            de Alas Peruanas y en la Universidad de Huánuco –en las cátedras de comunicación y marketing–, tuvo como sello distintivo
                            su profesionalismo y el fomento del amor a Huánuco en sus jóvenes alumnos.
                        </p>
                    </div>
                </div>
                <div class="flex w-full justify-center">
                    <UButton color="primary" variant="soft" class="mt-2" @click="expanded = !expanded">
                        {{ expanded ? 'Ver menos' : 'Ver más' }}
                    </UButton>
                </div>
            </UCard>
            <!-- Fila 2: Reencuentro -->
            <UCard class="flex w-full flex-col items-center justify-center gap-6 bg-card p-8 shadow-xl">
                <!-- Banner superior de Reencuentro -->
                <div class="relative mb-4 flex w-full items-end justify-center">
                    <img
                        src="/assets/images/reencuentro/banner.jpg"
                        alt="Banner Reencuentro"
                        class="max-h-64 w-full rounded-xl object-cover shadow"
                    />
                    <div
                        class="absolute bottom-0 left-0 h-20 w-full rounded-b-xl"
                        style="background: linear-gradient(to top, var(--background), transparent)"
                    ></div>
                </div>
                <div class="mt-8 w-full text-center text-2xl font-extrabold text-primary md:text-3xl">
                    <img src="/assets/images/brand/logotipo.png" alt="Reencuentro logotipo" class="mx-auto mb-2 w-48 object-contain" />
                </div>
                <p class="mb-8 text-center text-base font-semibold text-red-600 md:text-xl">Pasión por la cultura</p>
                <div
                    class="relative mx-auto grid w-full max-w-5xl grid-cols-1 gap-8 text-justify text-sm leading-relaxed text-foreground/90 md:grid-cols-2 md:text-base"
                    :class="expanded2 ? '' : 'max-h-64 overflow-hidden'"
                >
                    <div
                        v-if="!expanded2"
                        class="pointer-events-none absolute bottom-0 left-0 h-16 w-full bg-gradient-to-t from-background/90 to-transparent"
                    ></div>
                    <div class="space-y-4">
                        <p>
                            Reencuentro es un espacio que promueve el diálogo, la reconciliación y la valoración de la cultura huanuqueña a través de
                            historias humanas y testimonios inspiradores.
                        </p>
                        <p>
                            Desde sus inicios, el programa ha buscado rescatar las raíces y tradiciones de la región, fomentando el amor por lo
                            nuestro y el sentido de pertenencia.
                        </p>
                        <p>
                            A lo largo de los años, Reencuentro ha contado con la participación de destacados invitados y especialistas, enriqueciendo
                            el contenido y el alcance del programa.
                        </p>
                        <p>
                            La producción y difusión de Reencuentro ha sido posible gracias al compromiso y la pasión de su equipo, así como al apoyo
                            de la comunidad huanuqueña.
                        </p>
                        <img src="/assets/images/reencuentro/1.jpg" alt="Reencuentro 1" class="mx-auto my-2 w-9/12 rounded-xl object-cover shadow" />
                        <p class="font-bold mt-12">
                            Reencuentro, es ahora el espacio digital, que ha de preservar todo el legado acumulado en la construcción de la supraestructura de la sociedad huanuqueña.
                        </p>
                    </div>
                    <div class="space-y-4">
                        <p>
                            El programa se transmite en diferentes plataformas, llegando a un público diverso y generando un impacto positivo en la
                            sociedad.
                        </p>
                        <p>
                            Reencuentro no solo informa, sino que también inspira a nuevas generaciones a valorar y preservar el patrimonio cultural
                            de Huánuco.
                        </p>
                        <img src="/assets/images/reencuentro/3.jpg" alt="Reencuentro 3" class="mx-auto my-2 w-2/3 rounded-xl object-cover shadow" />
                        <p>
                            La interacción con la audiencia y la cobertura de eventos relevantes han fortalecido el vínculo entre el programa y la
                            comunidad.
                        </p>
                        <p>El legado de Reencuentro continúa creciendo, consolidándose como un referente de identidad y cultura en la región.</p>
                        <img src="/assets/images/reencuentro/2.jpg" alt="Reencuentro 2" class="mx-auto my-2 w-2/3 rounded-xl object-cover shadow" />
                    </div>
                </div>
                <div class="flex w-full justify-center">
                    <UButton color="primary" variant="soft" class="mt-2" @click="expanded2 = !expanded2">
                        {{ expanded2 ? 'Ver menos' : 'Ver más' }}
                    </UButton>
                </div>
            </UCard>
        </UContainer>
    </section>
</template>
