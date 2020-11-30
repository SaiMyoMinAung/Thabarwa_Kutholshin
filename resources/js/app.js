require('./bootstrap');

import Vue from 'vue';
import { VueReCaptcha } from 'vue-recaptcha-v3'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import { CoolSelectPlugin } from "vue-cool-select";
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
import "bootstrap-vue/dist/bootstrap-vue.css";
import("vue-cool-select/dist/themes/bootstrap.css");

Vue.use(CoolSelectPlugin);
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VueReCaptcha, {
  siteKey: process.env.MIX_RECAPTCHA_KEY,
  loaderOptions: {
    useRecaptchaNet: true,
  }
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('v-select', vSelect);

window.app = new Vue({
  el: '#app',
});
