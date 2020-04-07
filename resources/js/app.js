import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuetify from 'vuetify';
import router from './router';
import App from "./App";
import 'vuetify/dist/vuetify.min.css';
import store from './store';

Vue.use(VueRouter);
Vue.use(Vuetify);
Vue.config.devtools = true;

const vue = new Vue({
    router,
    store,
    render: h => h(App),
    vuetify: new Vuetify({
        theme:{
            themes: {
                light: {
                    primary: '#21273D',
                }
            }
        }
    })
});

vue.$mount("#app");
