import api from "./api";

export const get =  () => {
    return api.get(`/api/reviews`);
};

export const show = (id) => {
    return api.get(`/api/reviews/${id}`);
};

export const update = (id, status) => {
    return api.post(`api/reviews/${id}`, status, {
        headers: {
            'X-HTTP-Method-Override': 'PUT'
        }
    });
};
