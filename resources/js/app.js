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
        page.default.layout = page.default.layout || Layout;
        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el)
    },
})
