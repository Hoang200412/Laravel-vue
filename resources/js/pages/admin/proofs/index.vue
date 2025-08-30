<template>
    <a-card title="Danh sách bài nghiên cứu" :bordered="false" style="width: 100%">
        <template #extra>

        </template>
        <a-table :dataSource="proofs" :columns="columns" :scroll="{ x: '900px', y: '400px' }">
            <template #bodyCell="{ record, column, index }">
                <template v-if="column.dataIndex === 'index'">
                    <span>{{ index + 1 }}</span>
                </template>
                <template v-else-if="column.dataIndex === 'file_upload'">
                    <div class="d-flex justify-content-center">
                        <a-button type="" size="small" @click="signedUrl(record.id)">
                            <i class="fa-solid fa-download me-2 "></i>
                            Tải xuống
                        </a-button>
                    </div>
                </template>

                <template v-if="column.key === 'status'">
                    <span class="badge"
                        :class="{ 'bg-info': record.status === 'pending', 'bg-success': record.status !== 'approved', 'bg-danger': record.status === 'rejected' }">
                        {{ record.status === 'pending' ? 'Đang chờ' : record.status === 'approved' ? 'Đã duyệt' : 'Bị từ chối' }}
                    </span>
                </template>

                <template v-if="column.key === 'action'">
                    <div class="d-flex justify-content-around">
                        <router-link :to="{ name:'proof-show', params: { id: record.id } }">
                            <a-button type="primary" size="small" >
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a-button>
                        </router-link>
                    </div>
                </template>
            </template>
        </a-table>
    </a-card>
</template>

<script setup>
    import { onMounted, ref } from 'vue';
    import { get } from '../../../services/reviewService';

    const proofs = ref([]);
    onMounted(() => {
        getProofs();
    });

    const getProofs = async () => {
        try {
            const response = await get('/proofs');
            proofs.value = response.data;
        } catch (error) {
            console.error('Failed to fetch proofs:', error);
        }
    }

    const columns = [
        {
            title: 'STT',
            dataIndex: 'index',
            key: 'index',
            width: 60,
            align: 'center',
        },
        {
            title: 'Tiêu đề',
            dataIndex: 'title',
            key: 'title',
            width: 200,
            align: 'center',
        },
        {
            title: 'Tác giả',
            dataIndex: 'author',
            key: 'author',
            width: 150,
            align: 'center',
        },
        {
            title: 'Mô tả',
            dataIndex: 'description',
            key: 'description',
            width: 300,
            align: 'center',
        },
        {
            title: 'Trạng thái',
            dataIndex: 'status',
            key: 'status',
            width: 100,
            align: 'center',
        },
        {
            title: 'Tải file',
            dataIndex: 'file_upload',
            key: 'file_upload',
            width: 100,
            align: 'center',
        },
        {
            title: 'Hành động',
            key: 'action',
            width: 100,
            align: 'center',
        },
    ];


</script>