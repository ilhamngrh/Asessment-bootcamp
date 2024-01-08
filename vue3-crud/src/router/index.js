import { createRouter, createWebHistory } from 'vue-router'

//define a routes
const routes = [
    {
        path: '/',
        name: 'home',
        component: () => import( /* webpackChunkName: "home" */ '../views/home.vue')
    },
    {
        path: '/mahasiswa',
        name: 'mahasiswa.index',
        component: () => import( /* webpackChunkName: "index" */ '../views/mahasiswa/index.vue')
    },
    {
        path: '/create',
        name: 'mahasiswa.create',
        component: () => import( /* webpackChunkName: "create" */ '../views/mahasiswa/create.vue')
    },
    {
        path: '/edit/:id',
        name: 'mahasiswa.edit',
        component: () => import( /* webpackChunkName: "edit" */ '../views/mahasiswa/edit.vue')
    },
    {
        path: '/matakuliah',
        name: 'matakuliah.index',
        component: () => import( /* webpackChunkName: "index" */ '../views/matakuliah/index.vue')
    },
    {
        path: '/dosen',
        name: 'dosen.index',
        component: () => import( /* webpackChunkName: "index" */ '../views/dosen/index.vue')
    },
    {
        path: '/prodi',
        name: 'prodi.index',
        component: () => import( /* webpackChunkName: "index" */ '../views/prodi/index.vue')
    },
]

//create router
const router = createRouter({
    history: createWebHistory(),
    routes // <-- routes,
})

export default router