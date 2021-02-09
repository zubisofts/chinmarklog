require('./bootstrap');

require('moment');

import Vue from 'vue';

import { InertiaApp } from '@inertiajs/inertia-vue';
import { InertiaForm } from 'laravel-jetstream';
import PortalVue from 'portal-vue';

// Adding Font-Awesome Library
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faBell, faClock, faEye, faFileAlt, faHandPointer, faQuestionCircle, faSave, faStopCircle, faUser } from '@fortawesome/free-regular-svg-icons';
import { faArrowLeft, faArrowRight, faCalculator, faCar, faCheckCircle, faCircleNotch, faCogs, faEnvelope, faGift, faHandPointDown, faHandPointRight, faHeadset, faHistory, faHome, faHotel, faInfoCircle, 
    faMapMarker, faMapPin, faMotorcycle, faPaperPlane, faPhoneAlt, faPhoneSquareAlt, faPlus, faShare, faShippingFast, faSignOutAlt, faStopwatch, faThumbtack, 
    faTimes, faTimesCircle, faTruckMoving, faUserCog, faUsers, faWarehouse } from '@fortawesome/free-solid-svg-icons';
import { faFacebookSquare, faInstagram, faMarkdown, faRev, faServicestack, faTwitter, faWhatsapp, faYoutube } from '@fortawesome/free-brands-svg-icons';

library.add(faClock, faMapMarker, faHome, faInfoCircle, faCogs, faServicestack, faQuestionCircle, faThumbtack, faRev, 
    faFacebookSquare, faPhoneSquareAlt, faFileAlt, faTwitter, faWhatsapp, faInstagram, faHandPointer, faTruckMoving, 
    faShippingFast, faTimes, faBell, faSignOutAlt, faUsers, faMotorcycle, faPlus, faSave, faHeadset, faUserCog, faCar,
    faGift, faShare, faUser, faArrowLeft, faPaperPlane, faEnvelope, faPhoneAlt, faHistory, faStopwatch, 
    faMapPin, faCalculator, faWarehouse, faYoutube, faTimesCircle, faCircleNotch, faCheckCircle, faMarkdown, faHandPointRight, 
    faHandPointDown, faHotel, faArrowRight, faEye, faStopCircle)

Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.config.productionTip = false

// CKEDitor
import CKEditor from '@ckeditor/ckeditor5-vue';
Vue.use( CKEditor ); 

// Pusher
// Channel
import Echo from 'laravel-echo';
import Pusher from "pusher-js";

window.pusher = new Pusher(process.env.MIX_PUSHER_APP_KEY, {
    cluster: 'eu'
  });

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});

// Beam
import * as PusherPushNotifications from "@pusher/push-notifications-web";
const beamsClient = new PusherPushNotifications.Client({
    instanceId: 'e3767c79-1d0a-496a-818c-02ae3788a180',
});

beamsClient.start()
    .then(() => beamsClient.addDeviceInterest('hello'))
    .then(() => console.log('Successfully registered and subscribed!'))
    .catch(console.error);


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
