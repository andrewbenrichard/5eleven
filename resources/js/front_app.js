/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

import store from "./store";
require("./store/subscriber");

import { Form, HasError, AlertError } from "vform";
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

import VueRouter from "vue-router";

Vue.use(VueRouter);


let routes = [
    {
        path: "",
        name: "home",
        component: require("./components/frontendComponents/pages/home.vue")
            .default
    },
    {
        path: "/stores",
        name: "stores",
        component: require("./components/frontendComponents/pages/stores.vue")
            .default
    },
    {
        path: "/pages/track",
        name: "track",
        component: require("./components/frontendComponents/pages/track.vue")
            .default
    },
    {
        path: "/shop/cart",
        name: "cart",
        component: require("./components/frontendComponents/pages/cart_page.vue")
            .default
    },
    {
        path: "/shop/checkout",
        name: "checkout",
        component: require("./components/frontendComponents/pages/checkout.vue")
            .default
    },
    {
        path: "/contact",
        component: require("./components/frontendComponents/pages/contact.vue")
            .default
    },
    {
        path: "/about-us",
        component: require("./components/frontendComponents/pages/about_us.vue")
            .default
    },
    {
        path: "/login",
        component: require("./components/frontendComponents/pages/login.vue")
            .default
    },
    {
        path: "/register",
        component: require("./components/frontendComponents/pages/register.vue")
            .default
    },
    {
        path: "/blog",
        component: require("./components/frontendComponents/pages/blog.vue")
            .default
    },
    {
        path: "/article/:slug",
        component: require("./components/frontendComponents/pages/article.vue")
            .default
    },
    {
        path: "/product/:slug",
        component: require("./components/frontendComponents/singles/product.vue")
            .default
    },
    {
        path: "/404",
        name: "404",
        component: require("./components/frontendComponents/pages/NotFound.vue")
            .default
    },

    {
        path: "/log_admin/",
        name: "log_admin",
        beforeEnter() {
            location.href = "/dashboard";
        }
    },
    { path: "*", redirect: "/404" }
];

const router = new VueRouter({
    mode: "history",
    routes // short for `routes: routes`
});
/**
 * The following block of code may be used to automatically register your
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
store.dispatch("auth/attempt", localStorage.getItem("token")).then(() => {
    const app = new Vue({
        store,
        el: "#app",
        router
    });
});
