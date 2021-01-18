require('./bootstrap');

require('moment');

import Vue from 'vue';

import { InertiaApp } from '@inertiajs/inertia-vue';
import { InertiaForm } from 'laravel-jetstream';
import PortalVue from 'portal-vue';

// Adding Font-Awesome Library
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faBell, faClock, faFileAlt, faHandPointer, faQuestionCircle, faSave, faUser } from '@fortawesome/free-regular-svg-icons';
import { faArrowLeft, faCar, faCogs, faEnvelope, faGift, faHeadset, faHome, faInfoCircle, faMapMarker, faMotorcycle, faPaperPlane, faPhoneAlt, faPhoneSquareAlt, faPlus, faShare, faShippingFast, faSignOutAlt, faThumbtack, 
    faTimes, faTruckMoving, faUserCog, faUsers } from '@fortawesome/free-solid-svg-icons';
import { faFacebookSquare, faInstagram, faRev, faServicestack, faTwitter, faWhatsapp } from '@fortawesome/free-brands-svg-icons';

library.add(faClock, faMapMarker, faHome, faInfoCircle, faCogs, faServicestack, faQuestionCircle, faThumbtack, faRev, 
    faFacebookSquare, faPhoneSquareAlt, faFileAlt, faTwitter, faWhatsapp, faInstagram, faHandPointer, faTruckMoving, 
    faShippingFast, faTimes, faBell, faSignOutAlt, faUsers, faMotorcycle, faPlus, faSave, faHeadset, faUserCog, faCar,
    faGift, faShare, faUser, faArrowLeft, faPaperPlane, faEnvelope, faPhoneAlt)

Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.config.productionTip = false

// CKEDitor
import CKEditor from '@ckeditor/ckeditor5-vue';
Vue.use( CKEditor ); 


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
