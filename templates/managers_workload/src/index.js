import Vue from 'vue';
import App from './components/app/App.vue';

Vue.config.productionTip = false
console.log(window)
window.onload = function () {
    new Vue({
        el: '#app',
        render: h => h(App)
    })
}