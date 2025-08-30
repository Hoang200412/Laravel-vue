import api from "./api";

export const get =  () => {
    return api.get("api/proofs");
}

export const create  = () => {
    return api.get("api/proofs/create");
}

export const store = (data) => {
    return api.post("api/proofs", data);
}

export const edit = (id) => {
    return api.get(`api/proofs/${id}/edit`);
}

export const update = (data, id) => {
    return api.post(`api/proofs/${id}`, data, {
        headers: {
            'X-HTTP-Method-Override': 'PUT'
        }
    });
}

export const destroy = (id) => {
    return api.delete(`api/proofs/${id}`);
}

export const getSignedUrl = (id) => {
    return api.get(`api/proof/signed-url/${id}`);
};

export const getDashboardStats = () => {
    return api.get("api/proof/dashboard-stats");
}

export const getTopAuthors = () => {
    return api.get("api/proof/top-authors");
}