import '../css/app.css';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import type { DefineComponent } from 'vue';
import { createApp, h } from 'vue';
import { ZiggyVue } from 'ziggy-js';
import { initializeTheme } from './composables/useAppearance';

// Importar el plugin de Nuxt UI
import ui from '@nuxt/ui/vue-plugin';
import AppWrapper from './components/AppWrapper.vue';

const appName = import.meta.env.VITE_APP_NAME || 'Reencuentro';

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    resolve: (name) => resolvePageComponent(`./pages/${name}.vue`, import.meta.glob<DefineComponent>('./pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        createApp({
            render: () => h(AppWrapper, {}, () => h(App, props)) })
                .use(plugin)
                .use(ZiggyVue)
                .use(ui) // Usar el plugin de Nuxt UI
                .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

// This will set light / dark mode on page load...
initializeTheme();
