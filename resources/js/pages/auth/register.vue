<template>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 mb-4 mb-md-0 col-lg-7 col-xl-6">
                    <img src="/images/another/Mobile login-bro.png" class="img-fluid" alt="Phone image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <form action="" method="POST">

                        <form-input nameInput="username" idInput="name" nameLabel="Tên đăng nhập" />

                        <form-input nameInput="email" idInput="email" nameLabel="Email" />

                        <form-input nameInput="password" idInput="password" nameLabel="Mật khẩu" />

                        <form-input nameInput="password_confirm" idInput="password_confirm"
                            nameLabel="Nhập lại mật khẩu" />

                        <button-size-xl name="Đăng ký" type-button="submit" class="btn-dark" @click="register()"/>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import FormInput from '@/components/formInput.vue';
import buttonSizeXl from '../../components/buttonSizeXl.vue';

</script>