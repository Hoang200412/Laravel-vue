<template>
    <div class="text-center p-3">
        <img :src="`/storage/${user.avatar}`" alt="avatar" class="rounded-circle border shadow-sm mb-3"
            style="width: 100px; height: 100px; object-fit: cover;">

        <h5 class="fw-bold mb-1">{{ user.name }}</h5>
        <p class="text-muted mb-1"><i class="fa-solid fa-envelope me-2"></i>{{ user.email }}</p>
        <p class="text-muted"><i class="fa-solid fa-user-shield me-2"></i>{{ user.role }}</p>

        <button class="btn btn-danger w-100 mt-3" @click="logout">
            <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
        </button>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { authStore } from '../stores/auth';
import { useRouter } from 'vue-router';

const router = useRouter();
const auth = authStore();

const user = ref({});

onMounted(async () => {
    user.value = await auth.getProfile();
});

const logout = async () => {
    await auth.logout('/api/logout');
    router.push({ name: 'login' });
};

</script>