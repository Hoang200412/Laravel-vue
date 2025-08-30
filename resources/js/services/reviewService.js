import api from "./api";

export const get =  () => {
    return api.get(`/api/reviews`);
};

export const show = (id) => {
    return api.get(`/api/reviews/${id}`);
};
