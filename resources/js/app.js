// import './bootstrap';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import './echo';

// Inertia Client Side Setup
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import Layout from './Layouts/Navbar.vue';

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })

        // Set the default layout for all pages
        let page = pages[`./Pages/${name}.vue`]

        // Only apply default layout if layout is undefined (not explicitly set, including null)
        if (page.default.layout === undefined) {
            page.default.layout = Layout;
        }
        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el)
    },
    progress: {
        // The color of the progress bar...
        color: 'blue',
        // Whether to include the default NProgress styles...
        includeCSS: true,
        // Whether the NProgress spinner will be shown...
        showSpinner: false,
    },
})
