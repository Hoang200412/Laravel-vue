<template>
    <div class="container p-2">
        <div class="title d-flex justify-content-between my-2">
            <h2>Danh sách người dùng</h2>
            <router-link :to="{ name: 'create-user' }">
                <a-button type="primary">Thêm người dùng</a-button>
            </router-link>
        </div>
        <a-table :dataSource="users" :columns="columns" :scroll="{ x: 600, y: 1000 }">
            <template #bodyCell="{ column, record, index }">
                <template v-if="column.key === 'index'">
                    <span>{{ index + 1 }}</span>
                </template>
                <template v-if="column.key === 'avatar'">
                    <div class="img">
                        <img :src="`http://127.0.0.1:8000/storage/${record.avata}`" alt="avatar"
                            style="width: 40px; height: auto;">
                    </div>
                </template>
                <template v-if="column.key === 'action'">
                    <div class="d-flex justify-content-around">
                        <a-button type="primary" size="small">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a-button>
                        <a-button type="primary" danger size="small" @click="deleteUser(record.id)">
                            <i class="fa-solid fa-trash"></i>
                        </a-button>
                    </div>
                </template>
            </template>
        </a-table>
    </div>
</template>
<script setup>
import { reactive, ref } from 'vue';

const users = ref([]);
const renerUsers = () => {
    axios.get('http://127.0.0.1:8000/api/users')
        .then(function (response) {
            users.value = response.data;
        })
        .catch(function (error) {
            console.log(error);
        })
        .finally(function () {
        });
}
renerUsers();

const deleteUser = (id) => {
    alert("Bạn có chắc chắn muốn xóa người dùng này?");
    axios.delete(`http://127.0.0.1:8000/api/users/${id}`)
        .then(function (response) {
            console.log(response);
            renerUsers();
        })
        .catch(function (error) {
            console.log(error);
        });
}


const columns = reactive([
    {
        title: '#',
        dataIndex: 'index',
        key: 'index',
        width: 60,
    },
    {
        title: 'Avatar',
        dataIndex: 'avata',
        key: 'avatar',
        width: 100,
    },
    {
        title: 'Họ và tên',
        dataIndex: 'name',
        key: 'name',
    },
    {
        title: 'Tên tài khoản',
        dataIndex: 'username',
        key: 'age',
    },
    {
        title: 'Email',
        dataIndex: 'email',
        key: 'address',
    },
    {
        title: 'Hành động',
        dataIndex: 'action',
        key: 'action',
        width: 120,
    }

]);

</script>