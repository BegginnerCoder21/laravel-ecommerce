import { createApp } from "vue/dist/vue.esm-bundler";
import './bootstrap';


import Alpine from 'alpinejs';

import AddToCart from './components/AddToCart.vue';
import NavbarCart from './components/NavbarCart.vue';
import Toaster from "@meforma/vue-toaster";


window.Alpine = Alpine;

Alpine.start();

const app = createApp();

app.use(Toaster).provide('toast',app.config.globalProperties.$toast);

app.component('AddToCart', AddToCart);
app.component('NavbarCart', NavbarCart);

app.mount('#app');
