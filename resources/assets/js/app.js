
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.bus = new Vue();

axios.defaults.baseURL = '';//'https://www3.sis.uta.fi/~ok415563/laravel';//works?


Vue.component('task-list', require('./components/TaskList.vue'));
Vue.component('custom-editor', require('./components/CustomEditor.vue'));

const app = new Vue({
    el: '#editor'
});