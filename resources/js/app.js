import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler.js';
import { createRouter, createWebHistory } from 'vue-router';
import routes from './routes';
import App from './App.vue'

const app = createApp(App);

const router = createRouter({
    history: createWebHistory(),
    routes, // Make sure this is the array of routes
});

app.use(router);

app.mount('#app');
