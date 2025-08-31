import api from "./api";

export const get = () => {
    return api.get("/api/users");
}

export const create = () => {
    return api.get("/api/users/create");
}

export const store = (data) => {
    return api.post("/api/users", data);
}

export const edit = (id) => {
    return api.get(`/api/users/${id}/edit`);
}

export const update = (id, data) => {
    return api.post(`/api/users/${id}`, data, {
        headers: {
            'X-HTTP-Method-Override': 'PUT'
        }
    });
}

export const destroy = (id) => {
    return api.delete(`/api/users/${id}`);
}
