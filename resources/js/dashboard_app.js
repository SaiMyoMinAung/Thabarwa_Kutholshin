require('./bootstrap');
require('material-design-icons');

import 'material-design-icons/iconfont/material-icons.css';
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
import Vue from 'vue';
import Toasted from 'vue-toasted';
import VirtualList from 'vue-virtual-scroll-list'
import Lang from 'lang.js';

const default_locale = window.default_locale;
const fallback_locale = window.fallback_locale;
const messages = window.messages;

Vue.prototype.trans = new Lang( { messages, locale: default_locale, fallback: fallback_locale } );

Vue.use(Toasted, {
  iconPack: 'material-icons',
  theme: "bubble",
  position: "top-center",
  duration: 3000
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
Vue.component('setting-component', require('./components/SettingComponent.vue').default);
Vue.component('online-manage-component', require('./components/OnlineManageComponent.vue').default);
Vue.component('manage-request', require('./components/ManageRequestComponent.vue').default);
Vue.component('internal-donated-item-component', require('./components/InternalDonatedItemComponent.vue').default);
Vue.component('share-internal-donated-item-component', require('./components/ShareInternalDonatedItemComponent.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('v-select', vSelect);
Vue.component('virtual-list', VirtualList)

window.dashboard_app = new Vue({
  el: '#dashboard-app'
});

import Echo from "laravel-echo"

window.Pusher = require('pusher-js');

window.Echo = new Echo({
  broadcaster: 'pusher',
  key: process.env.MIX_PUSHER_APP_KEY,
  wsHost: window.location.hostname,
  wsPort: 6001,
  forceTLS: false,
  disableStats: true,
});


