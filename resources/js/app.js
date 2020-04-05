import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuetify from 'vuetify';
import router from './router';
import App from "./App";
import 'vuetify/dist/vuetify.min.css';

Vue.use(VueRouter);
Vue.use(Vuetify);
Vue.config.devtools = true;

const vue = new Vue({
    router,
    render: h => h(App),
    vuetify: new Vuetify()
});

vue.$mount("#app");
