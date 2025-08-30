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
                <a-space >
                    <a-button type="default" @click="$router.push({ name: 'admin-proofs' })">
                        <i class="fa-solid fa-arrow-left me-1"></i> 
                        Quay lại
                    </a-button>
                </a-space>
            </template>

            <!-- Nội dung -->
            <div class="p-3">
                <div class="mb-3">
                    <span class="fw-bold me-2">👤 Tác giả:</span>
                    <span>{{ proof.author }}</span>
                </div>

                <div class="mb-3">
                    <span class="fw-bold me-2">📝 Mô tả:</span>
                    <span>{{ proof.description }}</span>
                </div>

                <div class="mb-3 d-flex align-items-center">
                    <span class="fw-bold me-2">📌 Trạng thái:</span>
                    <a-tag :color="proof.status === 'approved' ? 'green' : proof.status === 'pending' ? 'blue' : 'red'">
                        {{ proof.status === 'approved' ? 'Đã duyệt' : proof.status === 'pending' ? 'Đang chờ duyệt' :
                            'Bị từ chối'
                        }}
                    </a-tag>
                </div>

                <div class="mb-4">
                    <span class="fw-bold me-2">📅 Ngày tạo:</span>
                    <span>{{ formatDate(proof.created_at) }}</span>
                </div>

                <!-- Khung preview file -->
                <a-card type="inner"  class="shadow-sm">
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
                    <div v-else class="text-center p-5">
                        <i class="fa-solid fa-file-lines text-primary fs-1 mb-3"></i>
                        <p class="mb-2">Không thể xem trước, hãy tải xuống để mở</p>
                        <a-button type="primary" @click="downloadFile">
                            <i class="fa-solid fa-download me-1"></i> Tải xuống file
                        </a-button>
                    </div>
                </a-card>
            </div>
        </a-card>
    </div>
</template>


<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { show } from '../../../services/reviewService';
import { getSignedUrl } from '../../../services/proofService';
import { formatDate } from '../../../utils/format';
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



const downloadFile = () => {
    if (proof.value.file_upload) {
        window.open(proof.value.file_upload, "_blank");
    }
};
</script>
