/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import 'animate.css';
import "vue-toastification/dist/index.css";
// start the Stimulus application
import './bootstrap';

import  { createApp } from "vue";
import Toast from "vue-toastification";
import axios from "axios";
import VueAxios from "vue-axios";
import mitt from "mitt";

import  App from './js/App.vue';
import Home from "./js/pages/Home.vue";
import  * as VueRouter from 'vue-router';


const router = VueRouter.createRouter({
    history : VueRouter.createMemoryHistory(),
    routes : [
        {
            path: '/',
            name: 'Home',
            component : Home
        }
    ]
});

const app = createApp(App);
app.use(router).mount('#vue-app');
app.use(VueAxios, axios);
app.use(Toast);
const emitter = mitt();
app.mount('app');

