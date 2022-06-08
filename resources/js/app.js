require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp, Head, Link } from '@inertiajs/inertia-vue3';
import Toaster from '@meforma/vue-toaster';


createInertiaApp({
  resolve: name => require(`./Pages/${name}`),
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(Toaster)
      .component('InertiaHead', Head)
      .component('InertiaLink', Link)
      .use(plugin)
      .mount(el)
  },
})