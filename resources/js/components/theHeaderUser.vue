<template>
    <div class="container-fluid">
        <div class="row align-items-center p-3 bg-dark text-light">
            <div class="col-1 d-flex d-sm-none d-flex d-sm-none">
                <span class="text-center" @click="showDrawer()">
                    <i class="fa-solid fa-bars"></i>
                </span>
            </div>
            <div class="col-10 col-sm-9 justify-content-center d-flex d-flex justify-content-sm-start">
                <span class="d-flex d-sm-none">Trang chu</span>
                <span class="d-none d-sm-flex">Nghiên cứu khoa học</span>
            </div>
            <div class="col-sm-3 justify-content-end d-sm-flex d-none">
                <span class="fs-5 me-4">
                    <a-dropdown>
                        <a class="ant-dropdown-link" @click.prevent>
                            <i class="fa-solid fa-bell"> </i>
                        </a>
                        <template #overlay>
                            <a-card title="Notifications" :bordered="false" style="width: 300px">
                                <p>Notification 1</p>
                                <p>Notification 2</p>
                            </a-card>
                        </template>
                    </a-dropdown>
                </span>
                <span class="fs-5">
                    <i class="fa-solid fa-user" @click="showDrawer_user()"></i>
                </span>
            </div>
            <div class="col-1 d-flex d-sm-none">
                <span class="text-center" @click="showDrawer_user()">
                    <i class="fa-solid fa-user"></i>
                </span>
            </div>
        </div>
    </div>

    <a-drawer v-model:open="open" title="Danh muc" placement="left">
        <theMenuUser />
    </a-drawer>

    <a-drawer v-model:open="open_profile" title="" placement="right">
        <p>Some contents...</p>
        <p>Some contents...</p>
        <p>Some contents...</p>
        <button class="btn btn-danger" @click="logout">Logout</button>
    </a-drawer>

</template>

<script setup>
import { ref } from 'vue';
import theMenuUser from './theMenuUser.vue';
import { authStore } from '../stores/auth';
import { useRouter } from 'vue-router';
const router = useRouter();
const auth = authStore();

const open = ref(false);
const open_profile = ref(false);
const showDrawer = () => {
    open.value = true;
};
const showDrawer_user = () => {
    open_profile.value = true;
};

const logout = async () => {
  await auth.logout('/api/logout');
  router.push({ name: 'login' });
};


</script>