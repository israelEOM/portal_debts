import Home from './components/Home.vue';
import Admin from './components/admin/Admin.vue';

export const routes = [
    { 
        path: '/', 
        component: Home, 
        name: 'Home' 
    },
    { 
        path: '/admin', 
        component: Admin, 
        name: 'Admin',
        props: (route) => ({
            ...route.params
        })
    }
];