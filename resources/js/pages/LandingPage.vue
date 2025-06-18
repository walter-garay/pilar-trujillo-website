<template>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 px-4 py-12 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-4xl">
            <!-- Header -->
            <div class="mb-12 text-center">
                <h1 class="mb-4 text-4xl font-bold text-gray-900">Bienvenido a Pilar Trujillo</h1>
                <p class="text-xl text-gray-600">Formulario de contacto de ejemplo</p>
            </div>

            <!-- Formulario -->
            <div class="rounded-lg bg-white p-8 shadow-xl">
                <form @submit.prevent="submitForm" class="space-y-6">
                    <!-- Información Personal -->
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label for="nombre" class="mb-2 block text-sm font-medium text-gray-700"> Nombre completo * </label>
                            <input
                                id="nombre"
                                v-model="form.nombre"
                                type="text"
                                required
                                class="w-full rounded-md border border-gray-300 px-4 py-3 transition-colors focus:border-blue-500 focus:ring-2 focus:ring-blue-500"
                                placeholder="Ingresa tu nombre completo"
                            />
                        </div>

                        <div>
                            <label for="email" class="mb-2 block text-sm font-medium text-gray-700"> Correo electrónico * </label>
                            <input
                                id="email"
                                v-model="form.email"
                                type="email"
                                required
                                class="w-full rounded-md border border-gray-300 px-4 py-3 transition-colors focus:border-blue-500 focus:ring-2 focus:ring-blue-500"
                                placeholder="tu@email.com"
                            />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label for="telefono" class="mb-2 block text-sm font-medium text-gray-700"> Teléfono </label>
                            <input
                                id="telefono"
                                v-model="form.telefono"
                                type="tel"
                                class="w-full rounded-md border border-gray-300 px-4 py-3 transition-colors focus:border-blue-500 focus:ring-2 focus:ring-blue-500"
                                placeholder="+1 (555) 123-4567"
                            />
                        </div>

                        <div>
                            <label for="ciudad" class="mb-2 block text-sm font-medium text-gray-700"> Ciudad </label>
                            <input
                                id="ciudad"
                                v-model="form.ciudad"
                                type="text"
                                class="w-full rounded-md border border-gray-300 px-4 py-3 transition-colors focus:border-blue-500 focus:ring-2 focus:ring-blue-500"
                                placeholder="Tu ciudad"
                            />
                        </div>
                    </div>

                    <!-- Tipo de consulta -->
                    <div>
                        <label for="tipo_consulta" class="mb-2 block text-sm font-medium text-gray-700"> Tipo de consulta * </label>
                        <select
                            id="tipo_consulta"
                            v-model="form.tipo_consulta"
                            required
                            class="w-full rounded-md border border-gray-300 px-4 py-3 transition-colors focus:border-blue-500 focus:ring-2 focus:ring-blue-500"
                        >
                            <option value="">Selecciona una opción</option>
                            <option value="general">Consulta general</option>
                            <option value="servicios">Información sobre servicios</option>
                            <option value="soporte">Soporte técnico</option>
                            <option value="otro">Otro</option>
                        </select>
                    </div>

                    <!-- Mensaje -->
                    <div>
                        <label for="mensaje" class="mb-2 block text-sm font-medium text-gray-700"> Mensaje * </label>
                        <textarea
                            id="mensaje"
                            v-model="form.mensaje"
                            rows="5"
                            required
                            class="w-full resize-none rounded-md border border-gray-300 px-4 py-3 transition-colors focus:border-blue-500 focus:ring-2 focus:ring-blue-500"
                            placeholder="Describe tu consulta o mensaje aquí..."
                        ></textarea>
                    </div>

                    <!-- Checkbox de términos -->
                    <div class="flex items-start">
                        <input
                            id="terminos"
                            v-model="form.acepta_terminos"
                            type="checkbox"
                            required
                            class="mt-1 h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                        />
                        <label for="terminos" class="ml-3 text-sm text-gray-700">
                            Acepto los <a href="#" class="text-blue-600 hover:text-blue-500">términos y condiciones</a> y la
                            <a href="#" class="text-blue-600 hover:text-blue-500">política de privacidad</a>
                        </label>
                    </div>

                    <!-- Botón de envío -->
                    <div class="flex justify-center">
                        <button
                            type="submit"
                            :disabled="loading"
                            class="w-full rounded-md bg-blue-600 px-8 py-3 font-medium text-white transition-colors hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none disabled:cursor-not-allowed disabled:opacity-50 md:w-auto"
                        >
                            <span v-if="loading" class="flex items-center justify-center">
                                <svg
                                    class="mr-3 -ml-1 h-5 w-5 animate-spin text-white"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path
                                        class="opacity-75"
                                        fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                    ></path>
                                </svg>
                                Enviando...
                            </span>
                            <span v-else>Enviar mensaje</span>
                        </button>
                    </div>
                </form>

                <!-- Mensaje de éxito -->
                <div v-if="success" class="mt-6 rounded-md border border-green-200 bg-green-50 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">¡Mensaje enviado exitosamente!</p>
                            <p class="mt-1 text-sm text-green-700">Nos pondremos en contacto contigo pronto.</p>
                        </div>
                    </div>
                </div>

                <!-- Mensaje de error -->
                <div v-if="error" class="mt-6 rounded-md border border-red-200 bg-red-50 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800">Error al enviar el mensaje</p>
                            <p class="mt-1 text-sm text-red-700">
                                {{ error }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { reactive, ref } from 'vue';

// Estado del formulario
const form = reactive({
    nombre: '',
    email: '',
    telefono: '',
    ciudad: '',
    tipo_consulta: '',
    mensaje: '',
    acepta_terminos: false,
});

// Estados de la UI
const loading = ref(false);
const success = ref(false);
const error = ref('');

// Función para enviar el formulario
const submitForm = async () => {
    loading.value = true;
    error.value = '';
    success.value = false;

    try {
        await router.post('/contacto', form, {
            onSuccess: () => {
                success.value = true;
                // Limpiar formulario
                Object.assign(form, {
                    nombre: '',
                    email: '',
                    telefono: '',
                    ciudad: '',
                    tipo_consulta: '',
                    mensaje: '',
                    acepta_terminos: false,
                });
            },
            onError: (errors: any) => {
                error.value = 'Hubo un error al enviar el formulario. Por favor, intenta nuevamente.';
                console.error('Errores del formulario:', errors);
            },
        });
    } catch (err) {
        error.value = 'Error de conexión. Por favor, verifica tu conexión a internet.';
        console.error('Error:', err);
    } finally {
        loading.value = false;
    }
};
</script>
