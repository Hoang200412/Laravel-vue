<template>
    <a-card title="Danh sach bai nghien cuu" :bordered="false" style="width: 100%">
        <template #extra>
            <a-button type="primary">
                <i class="fa-solid fa-plus me-2"></i>
                Thêm bài nghiên cứu
            </a-button>
        </template>
        <a-table :dataSource="proofs" :columns="columns">
            
        </a-table>
    </a-card>
</template>

<script setup>
import { ref } from 'vue';
const proofs = ref([
    {
        index: 1,
        name: 'Nghiên cứu về AI',
        date: '2023-10-01',
        status: 'Đã nộp',
    },
    {
        index: 2,
        name: 'Nghiên cứu về Machine Learning',
        date: '2023-10-02',
        status: 'Chưa nộp',
    },
    {
        index: 3,
        name: 'Nghiên cứu về Deep Learning',
        date: '2023-10-03',
        status: 'Đã nộp',
    },
    {
        index: 3,
        name: 'Nghiên cứu về Deep Learning',
        date: '2023-10-03',
        status: 'Đã nộp',
    },
    {
        index: 3,
        name: 'Nghiên cứu về Deep Learning',
        date: '2023-10-03',
        status: 'Đã nộp',
    },
    {
        index: 3,
        name: 'Nghiên cứu về Deep Learning',
        date: '2023-10-03',
        status: 'Đã nộp',
    },
    {
        index: 3,
        name: 'Nghiên cứu về Deep Learning',
        date: '2023-10-03',
        status: 'Đã nộp',
    },
    {
        index: 3,
        name: 'Nghiên cứu về Deep Learning',
        date: '2023-10-03',
        status: 'Đã nộp',
    },
    {
        index: 3,
        name: 'Nghiên cứu về Deep Learning',
        date: '2023-10-03',
        status: 'Đã nộp',
    },
    {
        index: 3,
        name: 'Nghiên cứu về Deep Learning',
        date: '2023-10-03',
        status: 'Đã nộp',
    }
]);

const columns = [
    {
        title: '#',
        dataIndex: 'index',
        key: 'index',
    },
    {
        title: 'Tên bài nghiên cứu',
        dataIndex: 'name',
        key: 'name',
    },
    {
        title: 'Ngày nộp',
        dataIndex: 'date',
        key: 'date',
    },
    {
        title: 'Trạng thái',
        dataIndex: 'status',
        key: 'status',
    },
];

</script>