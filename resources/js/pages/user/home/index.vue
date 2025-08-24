<template>
    <div class="container py-4">
        <!-- Thống kê nhanh -->
        <div class="row g-4">
            <div class="col-md-6 col-lg-3" v-for="item in quickStats" :key="item.label">
                <a-card class="shadow-sm border-0 rounded-3" :style="{ background: item.bg, color: '#fff' }">
                    <div class="d-flex align-items-center">
                        <div class="me-3 fs-2">
                            <i :class="item.icon"></i>
                        </div>
                        <div>
                            <p class="mb-1 text-truncate" > {{ item.label }}</p>
                            <h3 class="fw-bold">{{ item.value }}</h3>
                        </div>
                    </div>
                </a-card>
            </div>
        </div>

        <!-- Tổng số giờ nghiên cứu -->
        <div class="row mt-4">
            <div class="col-12">
                <a-card class="shadow-sm border-0 rounded-3">
                    <div class="d-flex align-items-center">
                        <div class="me-3 fs-2 text-purple">
                            <i class="fa-solid fa-hourglass-half"></i>
                        </div>
                        <div>
                            <p class="mb-1">Tổng số giờ nghiên cứu</p>
                            <h3 class="fw-bold text-purple">{{ stats.total_hours }} giờ</h3>
                        </div>
                    </div>
                </a-card>
            </div>
        </div>

    </div>
</template>

<script setup>
import { ref, onMounted, computed } from "vue";
import { getDashboardStats } from "../../../services/proofService";
const stats = ref({
    total: 0,
    pending: 0,
    approved: 0,
    rejected: 0,
    total_hours: 0,
});

const quickStats = computed(() => [
    { label: "Tổng số bài", value: stats.value.total, icon: "fa-solid fa-file-lines", bg: "#0d6efd" },
    { label: "Đang chờ duyệt", value: stats.value.pending, icon: "fa-solid fa-clock", bg: "#ffc107" },
    { label: "Đã duyệt", value: stats.value.approved, icon: "fa-solid fa-circle-check", bg: "#28a745" },
    { label: "Bị từ chối", value: stats.value.rejected, icon: "fa-solid fa-ban", bg: "#dc3545" },
]);


// Table top tác giả
const authorColumns = [
    { title: "#", dataIndex: "index", key: "index", width: 50 },
    { title: "Tên tác giả", dataIndex: "author", key: "author" },
    { title: "Số bài nghiên cứu", dataIndex: "count", key: "count" },
];

onMounted(async () => {
    try {
        const response = await getDashboardStats();
        stats.value = response.data;
    } catch (error) {
        console.error(error);
    }
});
</script>

<style>
.text-purple {
    color: #6f42c1;
}
</style>
