require('./bootstrap');

window.Vue = require('vue');

import VueSocialauth from 'vue-social-auth';
import axios from 'axios';
import VueAxios from 'vue-axios';
import VueRouter from 'vue-router';

import VueMaterial from 'vue-material';
import 'vue-material/dist/vue-material.min.css';
import 'vue-material/dist/theme/default.css';

import { library } from '@fortawesome/fontawesome-svg-core';
import { faStar, faDownload, faExclamationCircle } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import VueTheMask from 'vue-the-mask';
import VueCookies from 'vue-cookies';
import { routes } from './routes';

Vue.use(VueRouter);
const router = new VueRouter({
    mode: 'history',
    routes
});

library.add(faStar, faDownload, faExclamationCircle);
Vue.use(VueTheMask);
Vue.use(VueCookies);
Vue.use(VueRouter)
Vue.use(VueAxios, axios)
Vue.use(VueSocialauth, {
    providers: {
        facebook: {
            clientId: '387508695683527',
            redirectUri: 'http://portal-bancooriginal.org/auth/facebook/callback' // Your client app URL
        },
        google: {
            clientId: '813047555100-8dljt4jvfibno55caa4kqpi1comrhga1.apps.googleusercontent.com',
            redirectUri: 'http://portal-bancooriginal.org/auth/google/callback' // Your client app URL
        },
    }
});

Vue.use(VueMaterial);
Vue.component('font-awesome-icon', FontAwesomeIcon);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('home', require('./components/Home.vue').default);
Vue.component('admin', require('./components/admin/Admin.vue').default);

const app = new Vue({
    router,
    el: '#app',
});
