<template>
    <a-card title="Tao moi tai khoan">
        <form method="POST" @submit.prevent="onSubmit">
            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="row text-center">
                        <div class="col-12 mb-3">
                            <a-avatar shape="square" :size="150">
                                <template #icon>
                                    <img :src="avatarPreview" alt="">
                                </template>
                            </a-avatar>
                        </div>

                        <div class="col-12">
                            <a-upload :showUploadList="false" :beforeUpload="beforeUpload">
                                <a-button type="primary">
                                    <i class="fa-solid fa-upload me-2"></i> Upload
                                </a-button>
                            </a-upload>
                        </div>
                    </div>

                </div>
                <div class="col-12 col-sm-8">
                    <div class="row mb-3 justify-content-end">
                        <div class="col-12 col-sm-3">
                            <label for="">
                                <span>*</span>
                                <span>Tình trạng</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <a-select ref="select" v-model:value="status" style="width: 100%" placeholder="Tình trạng">
                                <a-select-option v-for="item in datas.user_status" :value="item.id">
                                    {{ item.status }}
                                </a-select-option>
                            </a-select>
                        </div>

                    </div>
                    <div class="row mb-3 justify-content-end">
                        <div class="col-12 col-sm-3">
                            <label for="">
                                <span :class="{ 'text-danger': errors.name }">*</span>
                                <span>Họ và tên</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <a-input v-model:value="name" placeholder="Họ Tên" />
                        </div>
                        <span class="text-danger col-12 col-sm-9" v-if="errors.name">{{ errors.name[0] }}</span>

                    </div>
                    <div class="row mb-3 justify-content-end">
                        <div class="col-12 col-sm-3">
                            <label for="">
                                <span :class="{ 'text-danger': errors.username }">*</span>
                                <span>Tên đăng nhập</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <a-input v-model:value="username" placeholder="Tên đăng nhập" />
                        </div>
                        <span class="text-danger col-12 col-sm-9" v-if="errors.username">{{ errors.username[0] }}</span>
                    </div>
                    <div class="row mb-3 justify-content-end">
                        <div class="col-12 col-sm-3">
                            <label for="">
                                <span :class="{ 'text-danger': errors.department }">*</span>
                                <span>Phòng ban</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-9 ">
                            <a-select ref="select" v-model:value="department" style="width: 100%"
                                placeholder="Phòng ban">
                                <a-select-option v-for="item in datas.department" :value="item.id">
                                    {{ item.department }}
                                </a-select-option>
                            </a-select>
                        </div>
                        <span class="text-danger col-12 col-sm-9" v-if="errors.department">{{ errors.department[0] }}</span>

                    </div>
                    <div class="row mb-3 justify-content-end">
                        <div class="col-12 col-sm-3">
                            <label for="">
                                <span :class="{ 'text-danger': errors.email }">*</span>
                                <span>Email</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <a-input v-model:value="email" placeholder="Email" autocomplete="new-email" />
                        </div>
                        <span class="text-danger col-12 col-sm-9" v-if="errors.email">{{ errors.email[0] }}</span>
                    </div>
                    <div class="row mb-3 justify-content-end">
                        <div class="col-12 col-sm-3">
                            <label for="">
                                <span :class="{ 'text-danger': errors.password }">*</span>
                                <span>Mật khẩu</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <a-input-password v-model:value="password" placeholder="input password"
                                autocomplete="new-password" />
                        </div>
                        <span class="text-danger col-12 col-sm-9" v-if="errors.password">{{ errors.password[0] }}</span>
                    </div>
                    <div class="row mb-3 justify-content-end">
                        <div class="col-12 col-sm-3">
                            <label for="">
                                <span :class="{ 'text-danger': errors.password_confirm }">*</span>
                                <span>Nhập lại mật khẩu</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <a-input-password v-model:value="password_confirm" placeholder="input password"
                                autocomplete="new-password" />
                        </div>
                        <span class="text-danger col-12 col-sm-9" v-if="errors.password_confirm">{{ errors.password_confirm[0] }}</span>
                    </div>

                    <div class="row d-flex justify-content-end">
                        <div class="col-12 col-sm-2 my-2">
                            <router-link :to="{ name: 'admin-users' }" style="width: 100%;">
                                <a-button style="width: 100%;">Hủy</a-button>
                            </router-link>
                        </div>
                        <div class="col-12 col-sm-2 my-2">
                            <a-button type="primary" html-type="submit" style="width: 100%;">Lưu</a-button>
                        </div>

                    </div>
                </div>
            </div>
        </form>

    </a-card>
</template>
<script setup>
import axios from 'axios';
import { ref } from 'vue';
const avatarFile = ref(null);
const avatarPreview = ref('/images/avatar/avatar-default.jpg');
const department = ref(undefined);
const status = ref(undefined);
const datas = ref({});

const username = ref('');
const name = ref('');
const email = ref('');
const password = ref('');
const password_confirm = ref('');

const errors = ref({});

axios.get('http://127.0.0.1:8000/api/users/create')
    .then((response) => {
        datas.value = response.data;
    }).catch((err) => {
        console.log(err);
    });

const beforeUpload = (file) => {
    const isImage = file.type.startsWith('image/')
    const isLt2M = file.size / 1024 / 1024 < 2

    if (!isImage) {
        alert('Chỉ cho phép tải ảnh.');
        return false;
    }

    if (!isLt2M) {
        alert('Ảnh phải nhỏ hơn 2MB.');
        return false;
    }

    avatarFile.value = file;
    avatarPreview.value = URL.createObjectURL(file);
    return false;
}

const onSubmit = () => {
    errors.value = {};
    const formData = new FormData();
    formData.append('username', username.value);
    formData.append('name', name.value);
    formData.append('email', email.value);
    formData.append('password', password.value);
    formData.append('password_confirm', password_confirm.value);
    formData.append('department_id', department.value);
    formData.append('status_id', status.value);

    if (avatarFile.value) {
        formData.append('avatar', avatarFile.value);
    }
    axios.post('http://127.0.0.1:8000/api/users', formData)
        .then((response) => {
            console.log(response);
        })
        .catch((err) => {
            if (err.response && err.response.data && err.response.data.errors) {
                errors.value = err.response.data.errors;
            } else {
                console.error(err);
            }

        });
}

</script>