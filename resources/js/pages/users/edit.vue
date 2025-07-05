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
                                    Upload
                                </a-button>
                            </a-upload>
                        </div>
                    </div>

                </div>
                <div class="col-12 col-sm-8">
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3">
                            <label for="">
                                <span>*</span>
                                <span>Tình trạng</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <a-select ref="select" v-model:value="status" style="width: 100%">
                                <a-select-option v-for="item in datas.user_status" :value="item.id">{{ item.status
                                }}</a-select-option>
                            </a-select>
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3">
                            <label for="">
                                <span>*</span>
                                <span>Họ và tên</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <a-input v-model:value="name" placeholder="Basic usage" />
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3">
                            <label for="">
                                <span>*</span>
                                <span>Tên đăng nhập</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <a-input v-model:value="username" placeholder="Basic usage" />
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3">
                            <label for="">
                                <span>*</span>
                                <span>Phòng ban</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <a-select ref="select" v-model:value="department" style="width: 100%">
                                <a-select-option v-for="item in datas.department" :value="item.id">{{ item.department
                                }}</a-select-option>
                            </a-select>
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3">
                            <label for="">
                                <span>*</span>
                                <span>Email</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <a-input v-model:value="email" placeholder="Email" autocomplete="new-email" />
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3">
                            <label for="">
                                <span>*</span>
                                <span>Mật khẩu</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <a-input-password v-model:value="password" placeholder="input password"
                                autocomplete="new-password" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3">
                            <label for="">
                                <span>*</span>
                                <span>Nhập lại mật khẩu</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-9">
                            <a-input-password v-model:value="password_confirm" placeholder="input password"
                                autocomplete="new-password" />
                        </div>
                    </div>

                    <div class="row d-flex justify-content-end">
                        <div class="col-12 col-sm-2 my-2">
                            <router-link :to="{name : 'admin-users'}"  style="width: 100%;">
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



</script>