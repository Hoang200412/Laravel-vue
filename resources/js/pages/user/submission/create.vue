<template>
    <section class="bg-white rounded border-1 shadow p-3">
        <form action="">
            <label for="file-upload" class="form-label">Tải minh chứng</label>
            <a-upload v-model:file-list="fileList" name="file" :multiple="false" 
                :before-upload="beforeUpload" class="form-control">
                <a-button>
                    Chọn file PDF
                </a-button>
            </a-upload>

            <form-select v-model:value="formData.activitytype_id" label="Loại bài nghiên cứu"
                placeholder="--Chọn loại bài nghiên cứu--" :datas="activityTypes" :errorMessage="errors.activitytype_id ? errors.activitytype_id[0] : ''"/>
            <form-input v-model:value="formData.title" size="form-control-md" label="Tên bài nghiên cứu" name="title"
                type="text" placeholder="Nhập tên bài nghiên cứu" :errorMessage="errors.title ? errors.title[0] : ''"/>
            <form-input v-model:value="formData.note" size="form-control-md" label="Mô tả" name="note" type="textarea"
                placeholder="Nhập mô tả bài nghiên cứu" :errorMessage="errors.note ? errors.note[0] : ''"  />
            <form-input v-model:value="formData.hours_earned" size="form-control-md" label="Số giờ nghiên cứu"
                name="hours_earned" type="number" placeholder="Số giờ nghiên cứu khoa học" :disabled="true" />
            <button class="btn btn-primary mt-3" @click.prevent="submitForm">Lưu</button>
        </form>
    </section>
</template>

<script setup>
import { reactive, ref } from 'vue';
import { onMounted, watch } from 'vue';
import formInput from '../../../components/formInput.vue';
import formSelect from '../../../components/formSelect.vue';
import { create, store } from '../../../services/proofService';
import { message, Upload } from 'ant-design-vue';
import { notifySuccess, notifyError } from '../../../utils/notify';

const errors = ref({});
const fileList = ref([]);
const activityTypes = ref([]);
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
            console.log(error);
        });
}

onMounted(() => {
    createProof();
})

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
    errors.value = {};
    store(formData)
        .then((response) => {
            notifySuccess('Tạo bài nghiên cứu thành công!');
        })
        .catch((error) => {
            if (error.response.status === 422) {
                errors.value = error.response.data.errors;
            }else{
                notifyError(error);
            }
        });
}

</script>