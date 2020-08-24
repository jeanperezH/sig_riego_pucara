/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

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


Vue.component('example', require('./components/ExampleComponent.vue').default);
Vue.component('docente', require('./components/Docente.vue').default);
Vue.component('estudiante', require('./components/Estudiante.vue').default); 
Vue.component('curso', require('./components/curso.vue').default); 
Vue.component('docente_curso', require('./components/Docente_curso.vue').default);
Vue.component('sillabu', require('./components/Sillabu.vue').default);
Vue.component('carpeta', require('./components/Carpeta.vue').default);
Vue.component('inicio', require('./components/Inicio.vue').default);

const app = new Vue({
    el: '#app',
    data :{
        menu:0
    }
});
