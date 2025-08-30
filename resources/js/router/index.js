import { createRouter, createWebHistory } from "vue-router";

const admin = [
    {
        path: "/admin",
        name: "admin",
        component: () => import("../layouts/admin.vue"),
        children: [
            {
                path: "users",
                name: "admin-users",
                component: () => import("../pages/admin/users/index.vue"),
                meta: { auth: true, role: ["admin"] },
            },
            {
                path: "users/create",
                name: "create-user",
                component: () => import("../pages/admin/users/create.vue"),
                meta: { auth: true, role: ["admin"] },
            },
            {
                path: "settings",
                name: "admin-settings",
                component: () => import("../pages/admin/settings/index.vue"),
                meta: { auth: true, role: ["admin"] },
            },
            {
                path: "proofs",
                name: "admin-proofs",
                component: () => import("../pages/admin/proofs/index.vue"),
                meta: { auth: true, role: ["admin"] },
            },
            {
                path: "proofs/:id", 
                name: "proof-show",
                component: () => import("../pages/admin/proofs/show.vue"),
                meta: { auth: true, role: ["admin"] },
            },
            {
                path: "users/:id/edit",
                name: "edit-user",
                component: () => import("../pages/admin/users/edit.vue"),
                meta: { auth: true, role: ["admin"] },
            }
        ],
        meta: { auth: true, role: ["admin"] }
    }
];

const user = [
    {
        path: "/nckh",
        name: "nckh",
        component: () => import("../layouts/user.vue"),
        children: [
            {
                path: "home",
                name: "user-home",
                component: () => import("../pages/user/home/index.vue"),
                meta: { auth: true, role: ["user", "admin"] },
            },
            {
                path: "submission",
                name: "user-submission",
                component: () => import("../pages/user/submission/index.vue"),
                meta: { auth: true, role: ["user", "admin"] },
            },
            {
                path: "submission/create",
                name: "create-submission",
                component: () => import("../pages/user/submission/create.vue"),
                meta: { auth: true, role: ["user", "admin"] },
            },
            {
                path: "submission/:id/edit",
                name: "edit-submission",
                component: () => import("../pages/user/submission/edit.vue"),
                meta: { auth: true, role: ["user", "admin"] },
            }
        ],
        meta: { auth: true, role: ["user", "admin"] }
    }

];

const auth = [
    {
        path: "/login",
        name: "login",
        component: () => import("../pages/auth/login.vue"),
    },
    {
        path: "/register",
        name: "register",
        component: () => import("../pages/auth/register.vue"),
    },
    {
        path: "/403",
        name: "403",
        component: () => import("../pages/403/index.vue"),
    }
];

const routes = [...admin, ...user, ...auth];

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('token');
    const role = localStorage.getItem('role');

    if(to.name == 'nckh') {
        return next({ name: 'user-home' });
    }
    if (to.name == 'admin') {
        return next({ name: 'admin-proofs' });
    }

    if (to.meta.auth && !token) {
        return next({ name: 'login' });
    }else if(to.meta.auth && !to.meta.role.includes(role)) {
        return next({ name: '403' });
    }else if(token && to.name === 'login') {
        return next({ name: 'nckh' });
    }
    
    return next();
})

export default router;
