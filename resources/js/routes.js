//Dependencies
import Vue from 'vue';
import VueRouter from 'vue-router';

//Import components for routes
import Home from './pages/Home';
import Blog from './pages/Blog'
import PostDetail from './pages/PostDetail'

//Activation Router in Vue
Vue.use(VueRouter);

//Definition of routes
const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/blog',
            name: 'blog',
            component: Blog,
        },
        {
            path: '/blog/:slug',
            name: 'post-detail',
            component: PostDetail,
        },
    ]
});

//export of routes
export default router;