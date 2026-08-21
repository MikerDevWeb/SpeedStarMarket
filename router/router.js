import{ createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        path: '/',
        name: 'Home',
        component: () => import('@/views/home.vue')
    },
    {
        path: '/vehicle',
        name: 'vehicleView',
        component: () => import('@/views/vehicleView.vue')
    },
    {
        path: '/searching',
        name: 'searching',
        component: () => import('@/views/search.vue')
    },
    {
        path: '/account',
        name: 'account',
        component: () => import('@/views/account.vue')
    },
    {
        path: '/sell-my-vehicle',
        name: 'sellMyVehicle',
        component: () => import('@/views/sellMyVehicle.vue')
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;