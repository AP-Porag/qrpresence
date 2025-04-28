require('./bootstrap');

import Vue from "vue"
//const Vue = require("vue");
//
//window.Vue = require('vue').default;


Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
});

export default app;
