import { createRouter, createWebHistory } from "vue-router";

const admin = [
    {
        path: "/admin",
        name: "admin",
        component: () => import("../layouts/admin.vue"),
        children: [
            //
            {
                path: "users",
                name: "admin-users",
                component: () => import("../pages/users/index.vue"),
            },
            {
                path: "users/create",
                name: "create-user",
                component: () => import("../pages/users/create.vue")
            },
            {
                path: "settings",
                name: "admin-settings",
                component: () => import("../pages/settings/index.vue")
            },
            {
                path: "roles",
                name: "admin-roles",
                component: () => import("../pages/roles/index.vue")
            },
            {
                path: "users/:id/edit",
                name: "edit-user",
                component: () => import("../pages/users/edit.vue")
            }
        ]
    }
];

const routes = [...admin];

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;
