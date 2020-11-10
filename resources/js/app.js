/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import './bootstrap';
import Vue from 'vue';
import { pascalToKebab } from './utils/String';

import ExampleComponent from './components/ExampleComponent';

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Instantiate Vue root components
[ExampleComponent].forEach((c) => {
  if (process.env.NODE_ENV === 'development' && !c.name) {
    throw new Error('Component name is undefined.');
  }

  Vue.component(c.name, c);

  Array.from(document.getElementsByTagName(pascalToKebab(c.name))).forEach(
    (el) => new Vue({ el })
  );
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//   el: '#app',
// });
