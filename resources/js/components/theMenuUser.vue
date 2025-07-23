<template>

    <a-menu v-model:selectedKeys="selectedKeys" mode="inline" style="width: 100%"  theme="light">

        <a-menu-item key="admin-home">
            <router-link :to="{ name: 'user-home' }" class="text-decoration-none">Trang chủ</router-link>
        </a-menu-item>

        <a-menu-item key="user-submission">
            <router-link :to="{ name: 'user-submission' }"  class="text-decoration-none">Bài nghiên cứu khoa học</router-link>
        </a-menu-item>

    </a-menu>

</template>

<script setup>

import { ref } from 'vue';

const selectedKeys = ref([]);

</script>