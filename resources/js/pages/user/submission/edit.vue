<template>
    <section class="bg-white rounded border-1 shadow p-3">
        <form action="" @submit.prevent="submitForm">
            <label for="file-upload" class="form-label">Tải minh chứng</label>
            <a-upload v-model:file-list="fileList" name="file" :multiple="false" :before-upload="beforeUpload"
                class="form-control">
                <a-button>
                    Chọn file PDF
                </a-button>
            </a-upload>
            <a-button v-if="fileUrl" type="link" :href="fileUrl" target="_blank">
                <template #icon>
                    <i class="fa-solid fa-file-pdf"></i>
                </template>
                Xem file PDF
            </a-button>

            <form-select v-model:value="formData.activitytype_id" label="Loại bài nghiên cứu"
                placeholder="--Chọn loại bài nghiên cứu--" :datas="activityTypes"
                :errorMessage="errors.activitytype_id ? errors.activitytype_id[0] : ''" />
            <form-input v-model:value="formData.title" size="form-control-md" label="Tên bài nghiên cứu" name="title"
                type="text" placeholder="Nhập tên bài nghiên cứu" :errorMessage="errors.title ? errors.title[0] : ''" />
            <form-input v-model:value="formData.note" size="form-control-md" label="Mô tả" name="note" type="textarea"
                placeholder="Nhập mô tả bài nghiên cứu" :errorMessage="errors.note ? errors.note[0] : ''" />
            <form-input v-model:value="formData.hours_earned" size="form-control-md" label="Số giờ nghiên cứu"
                name="hours_earned" type="number" placeholder="Số giờ nghiên cứu khoa học" :disabled="true" />
            <div class="row d-flex justify-content-end">
                <div class="col-12 col-md-2 my-2">
                    <router-link :to="{ name: 'user-submission' }" style="width: 100%;">
                        <a-button style="width: 100%;">Hủy</a-button>
                    </router-link>
                </div>
                <div class="col-12 col-md-2 my-2">
                    <a-button type="primary" html-type="submit" style="width: 100%;">Cập nhật</a-button>
                </div>
            </div>
        </form>
    </section>
</template>

<script setup>
import { reactive, ref } from 'vue';
import { onMounted, watch } from 'vue';
import formInput from '../../../components/formInput.vue';
import formSelect from '../../../components/formSelect.vue';
import { create, edit, update } from '../../../services/proofService';
import { getSignedUrl } from '../../../services/proofService';
import { message, Upload } from 'ant-design-vue';
import { useRoute, useRouter } from 'vue-router';
import { notifySuccess, notifyError } from '../../../utils/notify';
const route = useRoute();
const router = useRouter();

const errors = ref({});
const fileList = ref([]);
const activityTypes = ref([]);
const fileUrl = ref('');

const formData = reactive({
    activitytype_id: '',
    title: '',
    note: '',
    hours_earned: '',
    file_upload: '',
});


const createProof = () => {
    create()
        .then((response) => {
            activityTypes.value = response.data;
        })
        .catch((error) => {
            notifyError(error.response.data);
        });
}

const getProofEdit = () => {
    edit(route.params.id)
        .then((response) => {
            formData.activitytype_id = response.data.activity_type_id;
            formData.title = response.data.title;
            formData.note = response.data.note;
            formData.hours_earned = response.data.hours_earned;
            formData.file_upload = response.data.file_path;
        })
        .catch((error) => {
            notifyError(error.response.data.message);
        });
}

onMounted(() => {
    createProof();
    getProofEdit();
    signedUrl(route.params.id);
})

const signedUrl = async (id) => {
    try {
        const response = await getSignedUrl(id);
        fileUrl.value = response.data.view_url;
    } catch (error) {
        notifyError(error);
    }
}

watch(() => formData.activitytype_id, (newValue) => {
    if (newValue) {
        const selectedActivity = activityTypes.value.find(
            (item) => item.id == newValue
        );
        formData.hours_earned = selectedActivity ? selectedActivity.hour_equivalent : '';
    } else {
        formData.hours_earned = '';
    }
});


const beforeUpload = file => {
    const isPDF = file.type === 'application/pdf';
    if (!isPDF) {
        message.error('Bạn chỉ có thể tải lên file PDF!');
        return Upload.LIST_IGNORE;
    }
    fileList.value = [file];
    formData.file_upload = file;
    return false;
};
    
const submitForm = () => {
    update(formData, route.params.id)
        .then((response) => {
            notifySuccess('Cập nhật thành công!');
            router.push({ name: 'user-submission' });
        })
        .catch((error) => {
            errors.value = error.response.data.errors;
            notifyError(error);
        });
}

</script>