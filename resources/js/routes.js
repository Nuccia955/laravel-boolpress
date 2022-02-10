//Dependencies
import Vue from 'vue';
import VueRouter from 'vue-router';


//Activation Router in Vue
Vue.use(VueRouter);

//Definition of routes
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        }
    ]
});

//export of routes
export default router;