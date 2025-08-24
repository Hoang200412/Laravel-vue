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
                        <a-button type="primary" size="small"
                            @click="router.push({ name: 'edit-submission', params: { id: record.id } })">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a-button>
                        <a-button type="primary" danger size="small" @click="deleteProof(record.id)">
                            <i class="fa-solid fa-trash"></i>
                        </a-button>
                    </div>
                </template>
            </template>
        </a-table>
    </a-card>
</template>

<script setup>
    
</script>