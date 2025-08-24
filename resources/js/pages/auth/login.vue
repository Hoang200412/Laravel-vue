<template>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 mb-4 mb-md-0 col-lg-7 col-xl-6">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
                        class="img-fluid" alt="Phone image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <form action="" method="POST" @submit.prevent="handleLogin">

                        <form-input name="username" id="username" label="Tên đăng nhập"
                            v-model:value="formData.username"
                            :error-message="auth.errors.username ? auth.errors.username[0] : ''" />

                        <form-input name="password" id="password" label="Mật khẩu" type="password"
                            v-model:value="formData.password"
                            :error-message="auth.errors.password ? auth.errors.password[0] : ''" />

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                                <label class="form-check-label" for="form1Example3">Lưu mật khẩu</label>
                            </div>
                        </div>

                        <button-size-xl name="Đăng nhập" type-button="submit" class="btn-dark" />

                        <a href="">Quên mật khẩu?</a>
                        <div class="d-flex mt-3">
                            <span>Bạn chưa có tài khoản?</span>
                            <router-link :to="{ name: 'register' }">Đăng ký</router-link>
                        </div>
                    </form>
                    <a href="" class="text-decoration-none">
                        <div
                            class="google_login d-flex border border-dark-subtle p-2 rounded-3 mt-3 align-items-center justify-content-center">
                            <div class="gg_img col-1">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Google_%22G%22_logo.svg/1200px-Google_%22G%22_logo.svg.png"
                                    alt="" class="img-fluid">
                            </div>
                            <div class="mx-3">
                                <span class="text-dark">Đăng nhập bằng Google</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import formInput from '../../components/formInput.vue';
import buttonSizeXl from '../../components/buttonSizeXl.vue';
import { reactive, ref } from 'vue';
import { authStore } from '../../stores/auth';
import { useRouter } from 'vue-router';
const formData = reactive({
    username: '',
    password: ''
});
const router = useRouter();
const { data, login } = authStore();
const auth = authStore();
const handleLogin = async () => {
    const success = await auth.login('/api/login', formData);

    if (success) {
        if (auth.isAdmin) {
            router.push({ name: 'admin' });
        } else if (auth.isUser) {
            router.push({ name: 'nckh' });
        }
    } else {
        console.error("Login failed");
    }
};

</script>