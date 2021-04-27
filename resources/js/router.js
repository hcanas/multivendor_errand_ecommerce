import { createRouter, createWebHistory } from 'vue-router';
import Home from "./pages/Home";
import Shop from "./pages/Shop";
import Stores from "./pages/Stores";
import Cart from "./pages/Cart";

const routes = [
    {
        path: '/',
        component: Home,
    },
    {
        path: '/shop',
        component: Shop,
    },
    {
        path: '/stores',
        component: Stores,
    },
    {
        path: '/cart',
        component: Cart,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
