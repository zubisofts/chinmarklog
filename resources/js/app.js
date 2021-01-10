require('./bootstrap');

require('moment');

import Vue from 'vue';

import { InertiaApp } from '@inertiajs/inertia-vue';
import { InertiaForm } from 'laravel-jetstream';
import PortalVue from 'portal-vue';

// Adding Font-Awesome Library
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faClock, faFileAlt, faQuestionCircle } from '@fortawesome/free-regular-svg-icons';
import { faCogs, faHome, faInfoCircle, faMapMarker, faPhoneSquareAlt, faThumbtack } from '@fortawesome/free-solid-svg-icons';
import { faFacebookSquare, faInstagram, faRev, faServicestack, faTwitter, faWhatsapp } from '@fortawesome/free-brands-svg-icons';

library.add(faClock, faMapMarker, faHome, faInfoCircle, faCogs, faServicestack, faQuestionCircle, faThumbtack, faRev, 
    faFacebookSquare, faPhoneSquareAlt, faFileAlt, faTwitter, faWhatsapp, faInstagram)

Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.config.productionTip = false

Vue.mixin({ methods: { route } });
Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);

const app = document.getElementById('app');

new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
