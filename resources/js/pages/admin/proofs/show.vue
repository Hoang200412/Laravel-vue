<template>
    <div class="container mt-4">
        <a-card class="shadow-lg rounded-3" :bordered="false">
            <!-- Header -->
            <template #title>
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-file-alt me-2 text-primary fs-5"></i>
                    <span class="fs-5 fw-bold">{{ proof.title }}</span>
                </div>
            </template>

            <template #extra>
                <a-space>
                    <a-button type="default" @click="$router.push({ name: 'admin-proofs' })">
                        <i class="fa-solid fa-arrow-left me-1"></i>
                        Quay lại
                    </a-button>
                </a-space>
            </template>

            <!-- Nội dung -->
            <div class="p-3">
                <div class="mb-3">
                    <span class="fw-bold me-2">
                        <i class="fa-regular fa-user"></i>
                        Tác giả:</span>
                    <span>{{ proof.author }}</span>
                </div>

                <div class="mb-3">
                    <span class="fw-bold me-2">
                        <i class="fa-regular fa-pen-to-square"></i>
                        Mô tả:</span>
                    <span>{{ proof.description }}</span>
                </div>

                <div class="d-flex align-items-center mb-3">
                    <span class="fw-bold">
                        <i class="fa-solid fa-square-check"></i>
                        Trạng thái:
                    </span>
                    <span class="badge ms-1" :class="formatClassStatus(proof.status)">{{ formatStatus(proof.status) }}</span>

                    <div class="ms-auto" v-if="proof.status === 'pending'">
                        <button class="btn btn-success btn-sm me-2" @click="updateStatus('approved')">
                            <i class="fa-solid fa-check me-1"></i>
                            Duyệt
                        </button>
                        <button class="btn btn-danger btn-sm" @click="updateStatus('rejected')">
                            <i class="fa-solid fa-xmark me-1"></i>
                            Từ chối
                        </button>
                    </div>
                </div>

                <div class="mb-4">
                    <span class="fw-bold me-2">
                        <i class="fa-regular fa-calendar-days"></i>
                        Ngày tạo:
                    </span>
                    <span>{{ formatDate(proof.created_at) }}</span>
                </div>

                <!-- Khung preview file -->
                <a-card type="inner" class="shadow-sm">

                    <template #title>
                        <a :href="viewFileUrl" class="text-decoration-none" target="_blank">
                            <i class="fa-solid fa-file me-2"></i>
                            Xem chi tiết
                        </a>
                    </template>

                    <template #extra>
                        <a-button type="primary" @click="downloadFile">
                            <i class="fa-solid fa-download me-1"></i> Tải xuống file
                        </a-button>
                    </template>

                    <div v-if="viewFileUrl" class="text-center">
                        <iframe :src="viewFileUrl" width="100%" height="300px" style="border: none;">
                        </iframe>
                    </div>
                </a-card>
            </div>
        </a-card>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { show, update } from '../../../services/reviewService';
import { getSignedUrl } from '../../../services/proofService';
import { formatDate } from '../../../utils/format';
import { notifySuccess, notifyError } from '../../../utils/notify';
import { formatStatus, formatClassStatus } from '../../../utils/format';
const route = useRoute();
const proof = ref({});
const viewFileUrl = ref('');

const getProof = async (id) => {
    try {
        const response = await show(id);
        proof.value = response.data;
    } catch (error) {
        console.error('Failed to fetch proof:', error);
    }
};

const signedUrl = async () => {
    try {
        const response = await getSignedUrl(route.params.id);
        viewFileUrl.value = response.data.view_url;
    } catch (error) {
        console.error('Failed to get signed URL:', error);
    }
}

onMounted(() => {
    getProof(route.params.id);
    signedUrl();
});

const updateStatus = async (newStatus) => {
    try {
        await update(proof.value.id, { status: newStatus });
        notifySuccess('Cập nhật trạng thái thành công');
        proof.value.status = newStatus;
    } catch (error) {
        notifyError(error.response.data.message);
    }
};


const downloadFile = () => {
    if (viewFileUrl.value) {
        window.open(viewFileUrl.value, '_blank');
    }
};

</script>
