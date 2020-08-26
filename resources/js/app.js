/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.component('inicio', require('./components/Inicio.vue').default);
Vue.component('Compuerta', require('./components/Compuerta.vue').default);
Vue.component('Compuerta2', require('./components/Compuerta2.vue').default);
Vue.component('Compuerta3', require('./components/Compuerta3.vue').default);
Vue.component('Rio', require('./components/Rio.vue').default);
Vue.component('Rio2', require('./components/Rio2.vue').default);
Vue.component('Rio3', require('./components/Rio3.vue').default);
Vue.component('Canal', require('./components/Canal.vue').default);
Vue.component('Canal2', require('./components/Canal2.vue').default);
Vue.component('Canal3', require('./components/Canal3.vue').default);
Vue.component('Chacra', require('./components/Chacra.vue').default);
Vue.component('Chacra2', require('./components/Chacra2.vue').default);
Vue.component('Chacra3', require('./components/Chacra3.vue').default);


const app = new Vue({
    el: '#app',
    data :{
        menu:0
    }
});
