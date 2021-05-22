import { createRouter, createWebHistory } from 'vue-router';
import Home from "./pages/Home";
import Shop from "./pages/Shop";
import Stores from "./pages/Stores";
import Cart from "./pages/Cart";
import User from "./pages/User";
import UserActivityLog from "./pages/user/ActivityLog";
import UserOrders from "./pages/user/Orders";

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
    {
        path: '/user/:id(\\d+)',
        component: User,
        children: [
            {
                path: 'activity_log',
                component: UserActivityLog,
            },
            {
                path: 'orders',
                component: UserOrders,
            },
        ],
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
