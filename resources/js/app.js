import { createApp } from "vue/dist/vue.esm-bundler";
import './bootstrap';

import Alpine from 'alpinejs';

import AddToCart from './components/AddToCart.vue';

window.Alpine = Alpine;

Alpine.start();

const app = createApp();

app.component('AddToCart', AddToCart);

app.mount('#app');
