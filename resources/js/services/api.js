import axios from "axios";
import { authStore } from "../stores/auth";

const auth = authStore();

const api = axios.create({
    baseURL: 'http://127.0.0.1:8000',
    headers: {
        'Content-Type': 'application/json',
        'Content-Type': 'multipart/form-data',

    },

})

api.interceptors.request.use(
    (config) => {
        if(auth.token) {
            config.headers.Authorization = `Bearer ${auth.token}`;
        }
        return config;
    },
    (error) => {
        return Promise.reject(error);
    }
);

api.interceptors.response.use(
    (response) => {
        return response;
    },
    (error) => {
        return Promise.reject(error);
    }
)

export default api;