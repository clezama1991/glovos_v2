/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import { TablePlugin } from 'bootstrap-vue'
import vSelect from 'vue-select'
import bootstrapSelect from 'bootstrap-select'
import "vue-select/src/scss/vue-select.scss";
// import notams from 'notams'
import notams from "notams/index.js";

// import installer from '@andresouzaabreu/vue-data-table'
// import DataTable from '@andresouzaabreu/vue-data-table'

// import Vuetable from 'vuetable-2';


// import Tagify from "@yaireo/tagify";

window.csrf_token = "{{ csrf_token() }}"

window.Vue = require('vue');

window.moment = require('moment');

window._ = require('lodash');

import VueRouter from 'vue-router'
import HighchartsVue from 'highcharts-vue'
Vue.use(HighchartsVue)

import Vuex from "vuex";
import Select2 from 'v-select2-component';
// Install BootstrapVue
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)
Vue.use(TablePlugin)
Vue.use(bootstrapSelect)
Vue.use(notams)

/**vuejs**/
import Toasted from 'vue-toasted';
Vue.config.productionTip = false
Vue.use(Toasted, {
  duration: 1800
})
/**vuejs**/

import 'bootstrap-vue/dist/bootstrap-vue.css';

// Install Vuex
Vue.use(Vuex);

// Install VueRouter
Vue.use(VueRouter)

 
 Vue.component('v-select', vSelect)


 import loading from "../js/loading";

const store = new Vuex.Store({
  state: { 
    
  },
  mutations: {
  },
  modules: {
    loading,
  },

})

import axios from "axios";

 
axios.interceptors.request.use((config) => {
  // store.commit("loading/setLoading", true);
  return config;
});

axios.interceptors.response.use(
  (res) => {
    // store.commit("loading/setLoading", false);
    return Promise.resolve(res);
  },
  (err) => {
    // store.commit("loading/setLoading", false);
    return Promise.reject(err);
  }
);
// Install vue-data-table
// installer(Vue, store);
// DataTable(Vue, store);


require('./filters');


require('./directives');

Vue.component('Select2', Select2);

// Vue.component("vuetable", Vuetable);

import VueSweetalert2 from 'vue-sweetalert2';

Vue.use(VueSweetalert2);
// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';

 

require('./components');

Vue.mixin({

  methods: {

  },

  computed: {
    set_privilegios() {
      return store.rol;
    }
  }
});


import base from './base' // cita
Vue.use (base);


const routes = [
  { 
      path: '/',  
      component: require('./components/bashboard_events.vue').default, 
  },  
  
  { path: '/pilotos',   component: require('./components/pilotos/index.vue').default, },   
  { path: '/pilotos/crear', component: require('./components/pilotos/create.vue').default, },  
  { path: '/pilotos/consultar/:id', props: true, component: require('./components/pilotos/show.vue').default, },  
  { path: '/pilotos/formularios/:id', props: true, component: require('./components/pilotos/formularios.vue').default, },  
  { path: '/pilotos/formularios/:id/entrenamiento/:id_formulario', props: true, component: require('./components/pilotos/formularios_show.vue').default, },  

  
  { path: '/globos',   component: require('./components/globos/index.vue').default, },   
  { path: '/globos/crear', component: require('./components/globos/create.vue').default, },  
  { path: '/globos/consultar/:id', props: true, component: require('./components/globos/show.vue').default, },  


  { path: '/globos/modelos',   component: require('./components/globos/modelos_globos/index.vue').default, },   
  { path: '/globos/modelos/crear', component: require('./components/globos/modelos_globos/create.vue').default, },  
  { path: '/globos/modelos/consultar/:id', props: true, component: require('./components/globos/modelos_globos/show.vue').default, },  
 
  { path: '/globos/quemadores',   component: require('./components/globos/quemadores/index.vue').default, },   
  { path: '/globos/quemadores/crear', component: require('./components/globos/quemadores/create.vue').default, },  
  { path: '/globos/quemadores/consultar/:id', props: true, component: require('./components/globos/quemadores/show.vue').default, },  
 
  { path: '/globos/cestas',   component: require('./components/globos/cestas/index.vue').default, },   
  { path: '/globos/cestas/crear', component: require('./components/globos/cestas/create.vue').default, },  
  { path: '/globos/cestas/consultar/:id', props: true, component: require('./components/globos/cestas/show.vue').default, },  
 
  { path: '/globos/botellas',   component: require('./components/globos/botellas/index.vue').default, },   
  { path: '/globos/botellas/crear', component: require('./components/globos/botellas/create.vue').default, },  
  { path: '/globos/botellas/consultar/:id', props: true, component: require('./components/globos/botellas/show.vue').default, },  
 
  { path: '/globos/bottom_end',   component: require('./components/globos/bottom_end/index.vue').default, },   
  { path: '/globos/bottom_end/crear', component: require('./components/globos/bottom_end/create.vue').default, },  
  { path: '/globos/bottom_end/consultar/:id', props: true, component: require('./components/globos/bottom_end/show.vue').default, },  
 
  { path: '/zonas',   component: require('./components/zonas/index.vue').default, },   
  { path: '/zonas/crear', component: require('./components/zonas/create.vue').default, },  
  { path: '/zonas/consultar/:id', props: true, component: require('./components/zonas/show.vue').default, },  
  

  { path: '/vuelos',   component: require('./components/vuelos/index.vue').default, },   
  { path: '/vuelos/crear', component: require('./components/vuelos/create.vue').default, },  
  { path: '/vuelos/crear/:dashboard', props: true, component: require('./components/vuelos/create.vue').default, },  
  { path: '/vuelos/consultar/:id', props: true, component: require('./components/vuelos/show.vue').default, },  
  { path: '/vuelos/consultar/:id/:dashboard', props: true, component: require('./components/vuelos/show.vue').default, },  
  { path: '/vuelos/multimedia/:id', props: true, component: require('./components/vuelos/multimedia.vue').default, },  

  
  { path: '/pedidos',   component: require('./components/pedidos/index.vue').default, },   
  { path: '/pedidos/consultar/:id', props: true, component: require('./components/pedidos/show.vue').default, },  
  { path: '/pedidos/consultar/:id/:dashboard', props: true, component: require('./components/pedidos/show.vue').default, },  
  { path: '/pedidos/sincronizacion', component: require('./components/pedidos/sincronizacion.vue').default, },  
  { path: '/pedidos-history', component: require('./components/pedidos/history.vue').default, },  
  { path: '/pedidos-lista-espera', component: require('./components/pedidos/lista_espera.vue').default, },  

  { path: '/pedidos-reservas-externas',   component: require('./components/pedidos/reservas_externas/index.vue').default, },   
  { path: '/pedidos-reservas-externas/crear', component: require('./components/pedidos/reservas_externas/create.vue').default, },  
  { path: '/pedidos-reservas-externas/consultar/:id', props: true, component: require('./components/pedidos/reservas_externas/show.vue').default, },  
  
  
  { path: '/pasajeros',   component: require('./components/pasajeros/index.vue').default, },   
 

  { path: '/comunicacion_riesgos',   component: require('./components/sms/comunicacion_riesgos/index.vue').default, },   
  { path: '/comunicacion_riesgos/crear', component: require('./components/sms/comunicacion_riesgos/create.vue').default, },  
  { path: '/comunicacion_riesgos/consultar/:id', props: true, component: require('./components/sms/comunicacion_riesgos/show.vue').default, },  
 

  { path: '/sop',   component: require('./components/sms/sop/index.vue').default, },     

  { path: '/informes/vuelos', component: require('./components/informes/vuelos.vue').default, },  
  { path: '/informes/vuelos/edit/:id', props: true, component: require('./components/informes/vuelos_edit.vue').default, },  
  { path: '/informes/vuelos_cancelados', component: require('./components/informes/vuelos_cancelados.vue').default, },  
  { path: '/informes/vuelos_cancelados/edit/:id', props: true, component: require('./components/informes/vuelos_cancelados_edit.vue').default, },  
  
  { path: '/cuenta', component: require('./components/cuenta/mi_perfil.vue').default, },  
  { path: '/cuenta/cambiar_clave', component: require('./components/cuenta/cambiar_clave.vue').default, },  


  
  { path: '/feedback',   component: require('./components/feedback/index.vue').default, },   
  { path: '/feedback/crear', component: require('./components/feedback/create.vue').default, },  
  { path: '/feedback/consultar/:id', props: true, component: require('./components/feedback/show.vue').default, },  
  
  { path: '/admin-permisos',   component: require('./components/accesos/permisos/index.vue').default, },   
  
  { path: '/admin-roles',   component: require('./components/accesos/roles/index.vue').default, },   
  { path: '/admin-roles/crear', component: require('./components/accesos/roles/create.vue').default, },  
  { path: '/admin-roles/consultar/:id', props: true, component: require('./components/accesos/roles/show.vue').default, },  
   
  { path: '/admin-usuarios',   component: require('./components/accesos/usuarios/index.vue').default, },   
  { path: '/admin-usuarios/crear', component: require('./components/accesos/usuarios/create.vue').default, },  
  { path: '/admin-usuarios/consultar/:id', props: true, component: require('./components/accesos/usuarios/show.vue').default, },  
   
  { 
    path: '/bashboard_admin', 
    name: 'dashboard_1',
    component: require('./components/bashboard_admin.vue').default,  
    beforeEnter: (to, from, next) => { 
      var rol =  ''; 
      if (localStorage.rol) {
        rol = localStorage.rol;
      } 
      if (rol=='Administrador'||rol=='Comercial'){
        next()
      }else if(rol=='empleado'){
        next('/mis_polizas')
      } 
    }   
  },

  
  { path: '/configuraciones/plataforma', component: require('./components/configuraciones/plataforma.vue').default, },
  { path: '/configuraciones/checklist', component: require('./components/configuraciones/checklist.vue').default, },
  { path: '/configuraciones/redaccion', component: require('./components/configuraciones/redacciones.vue').default, },
 
  { path: '/configuraciones/tipo_nubosidad',   component: require('./components/configuraciones/tipo_nubosidad/index.vue').default, },   
  { path: '/configuraciones/tipo_nubosidad/crear', component: require('./components/configuraciones/tipo_nubosidad/create.vue').default, },  
  { path: '/configuraciones/tipo_nubosidad/consultar/:id', props: true, component: require('./components/configuraciones/tipo_nubosidad/show.vue').default, },  
  
  { path: '/configuraciones/soguillas',   component: require('./components/configuraciones/soguillas/index.vue').default, },   
  { path: '/configuraciones/soguillas_calendario',   component: require('./components/configuraciones/soguillas/calendario.vue').default, },   
  { path: '/configuraciones/soguillas/crear', component: require('./components/configuraciones/soguillas/create.vue').default, },  
  { path: '/configuraciones/soguillas/consultar/:id', props: true, component: require('./components/configuraciones/soguillas/show.vue').default, },  
  
  { path: '/configuraciones/crons', component: require('./components/configuraciones/crons/index.vue').default, },  
  { path: '/configuraciones/notams', component: require('./components/configuraciones/notams/index.vue').default, },  

]

const router = new VueRouter({
  routes,
  linkActiveClass: "menu-item-active", // active class for non-exact links.
  linkExactActiveClass: "menu-item-active", // active class for *exact* links.
  scrollBehavior (to, from, savedPosition) {
    return { x: 0, y: 0 }
  }
})
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

$.fn.select2.defaults.set("theme", "bootstrap4");
$.fn.select2.defaults.set("width", "resolve");
$.fn.select2.defaults.set("placeholder", "Seleccione una Opción");

import LaravelPermissionToVueJS from '../js/LaravelPermissions';
Vue.use(LaravelPermissionToVueJS)


const app = new Vue({
    el: '#app',
    router,
    store, 
    data: () => ({
	    csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
	    
	 })
});