<template>
    <a-card title="Danh sách bài nghiên cứu" :bordered="false" style="width: 100%">
        <template #extra>
            <a-button type="primary">
                <router-link :to="{ name: 'create-submission' }" class="text-decoration-none">
                    <i class="fa-solid fa-plus me-2"></i>
                    Thêm bài nghiên cứu
                </router-link>
            </a-button>
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

                <template v-if="column.dataIndex === 'created_at'">
                    {{ formatDate(record.created_at) }}
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
import { ref, onMounted } from 'vue';
import { destroy, get, getSignedUrl } from '../../../services/proofService';
import { useRouter } from 'vue-router';
import { formatDate } from '../../../utils/format';
const proofs = ref([]);
const fileUrl = ref('');
const router = useRouter();
onMounted(async () => {
    getProofs();
});

const signedUrl = async (id) => {
    try {
        const response = await getSignedUrl(id);
        const signedUrl = response.data.download_url;
        window.location.href = signedUrl;
    } catch (error) {
        console.log(error);
    }
};



const getProofs = async () => {
    try {
        const response = await get();
        proofs.value = response.data;
    } catch (error) {
        console.log(error);
    }
};

const deleteProof = (id) => {
    destroy(id)
        .then((res) => {
            getProofs();
        })
        .catch((error) => {
            console.log(error);
        })
}


const columns = [
    {
        title: '#',
        dataIndex: 'index',
        key: 'index',
        width: 50
    },
    {
        title: 'File minh chứng',
        dataIndex: 'file_upload',
        key: 'file_upload',
        width: 140
    },
    {
        title: 'Tác giả',
        dataIndex: 'author',
        key: 'author',
    },
    {
        title: 'Tên bài nghiên cứu',
        dataIndex: 'title',
        key: 'title',
    },
    {
        title: 'Trạng thái',
        dataIndex: 'status',
        key: 'status',
        width: 90
    },
    {
        title: 'Ngày nộp',
        dataIndex: 'created_at',
        key: 'created_at',
    },
    {
        title: 'Hành động',
        key: 'action',
        width: 110,
        fixed: 'right'
    },
];

</script>