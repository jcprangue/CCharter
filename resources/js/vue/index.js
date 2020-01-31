import Vue from 'vue';
import App from './pages/App.vue';
import router from './router';
import store from './storage';
const app = new Vue({
    el: '#app',
    template: '<app></app>',
    components: { App },
    router,
    store
});