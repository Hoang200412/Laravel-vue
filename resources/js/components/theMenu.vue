<template>

    <a-menu v-model:selectedKeys="selectedKeys" mode="inline" style="width: 100%">

        <a-menu-item key="admin-roles">
            <router-link :to="{ name: 'admin-roles' }" class="text-decoration-none">Vai trò</router-link>
        </a-menu-item>

        <a-menu-item key="admin-users">
            <router-link :to="{ name: 'admin-users' }" class="text-decoration-none">Người dùng</router-link>
        </a-menu-item>

        <a-menu-item key="admin-settings">
            <router-link :to="{ name: 'admin-settings' }" class="text-decoration-none">Cài đặt</router-link>
        </a-menu-item>

    </a-menu>

</template>

<script setup>

import { ref } from 'vue';

const selectedKeys = ref([]);

</script>