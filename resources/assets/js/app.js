
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueSweetAlert from 'vue-sweetalert'
Vue.use(VueSweetAlert)

import Vue from 'vue'
import money from 'v-money'

import VueMask from 'v-mask'
Vue.use(VueMask);

// register directive v-money and component <money>
Vue.use(money, {precision: 4})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('content-header', require('./components/ContentHeader.vue'));
Vue.component('data-table', require('./components/DataTable.vue'));
Vue.component('tabs', require('./components/Tabs.vue'));
Vue.component('ui-form', require('./components/UIForm.vue'));
Vue.component('ui-select', require('./components/UISelect.vue'));
Vue.component('ui-textarea', require('./components/UITextarea.vue'));
Vue.component('ui-money', require('./components/UIMoney.vue'));
Vue.component('ui-phone', require('./components/UIPhone.vue'));
Vue.component('ui-mask-input', require('./components/UIMaskInput.vue'));
Vue.component('alert', require('./components/Alert.vue'));
Vue.component('checkboxes', require('./components/Checkboxes.vue'));
Vue.component('radios', require('./components/Radios.vue'));
Vue.component('dropdown-list', require('./components/DropdownList.vue'));
Vue.component('dropdown-events', require('./components/DropdownEvents.vue'));
Vue.component('cidade-bairro', require('./components/Cidade-bairro.vue'));

const app = new Vue({
    el: '#app'
});
