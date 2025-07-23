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
            },
            {
                path: "users/create",
                name: "create-user",
                component: () => import("../pages/admin/users/create.vue")
            },
            {
                path: "settings",
                name: "admin-settings",
                component: () => import("../pages/admin/settings/index.vue")
            },
            {
                path: "roles",
                name: "admin-roles",
                component: () => import("../pages/admin/roles/index.vue")
            },
            {
                path: "users/:id/edit",
                name: "edit-user",
                component: () => import("../pages/admin/users/edit.vue")
            }
        ]
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
                component: () => import("../pages/user/home/index.vue")
            },
            {
                path: "submission",
                name: "user-submission",
                component: () => import("../pages/user/submission/index.vue")
            },
            
            
        ]
    }

];

const auth = [
    {
        path: "/login",
        name: "login",
        component: () => import("../pages/auth/login.vue")
    },
    {
        path: "/register",
        name: "register",
        component: () => import("../pages/auth/register.vue")
    },
];

const routes = [...admin, ...user, ...auth];

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;
