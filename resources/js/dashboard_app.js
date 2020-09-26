require('./bootstrap');
require('material-design-icons');
import 'material-design-icons/iconfont/material-icons.css';

import Vue from 'vue';
import Toasted from 'vue-toasted';

Vue.use(Toasted, { 
    iconPack : 'material-icons',
    theme: "bubble", 
    position: "top-center", 
    duration : 3000
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
Vue.component('setting-component', require('./components/SettingComponent.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

const dashboard_app = new Vue({
    el: '#dashboard-app'
});
