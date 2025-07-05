<template>
    <div class="container-fluid">
        <div class="row align-items-center bg-success-subtle p-3">
            <div class="col-1 d-flex d-sm-none d-flex d-sm-none">
                <span class="text-center" @click="showDrawer()">X</span>
            </div>
            <div class="col-10 col-sm-9 justify-content-center d-flex d-flex justify-content-sm-start">
                <span class="d-flex d-sm-none">Header</span>
                <span class="d-none d-sm-flex">Trang quan tri</span>
            </div>
            <div class="col-sm-3 justify-content-end d-sm-flex d-none">
                <span>Admin</span>
            </div>
            <div class="col-1 d-flex d-sm-none d-flex d-sm-none">
                <span class="text-center" @click="showDrawer_admin()">X</span>
            </div>
        </div>
    </div>

    <a-drawer v-model:open="open" title="Danh muc" placement="left">
        <theMenu/>
    </a-drawer>

    <a-drawer v-model:open="open_profile" title="Admin" placement="right">
        <p>Some contents...</p>
        <p>Some contents...</p>
        <p>Some contents...</p>
    </a-drawer>

</template>

<script setup>

    import { ref } from 'vue';
    import theMenu from './theMenu.vue';
    const open = ref(false);
    const open_profile = ref(false);
    const showDrawer = () => {
        open.value = true;
    };
    const showDrawer_admin = () => {
        open_profile.value = true;
    };

</script>