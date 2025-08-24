import api from "./api";

export const get =  () => {
    return api.get("api/proof");
}

export const create  = () => {
    return api.get("api/proof/create");
}

export const store = (data) => {
    return api.post("api/proof", data);
}

export const edit = (id) => {
    return api.get(`api/proof/${id}/edit`);
}

export const update = (data, id) => {
    return api.post(`api/proof/${id}`, data, {
        headers: {
            'X-HTTP-Method-Override': 'PUT'
        }
    });
}

export const destroy = (id) => {
    return api.delete(`api/proof/${id}`);
}

export const getSignedUrl = (id) => {
    return api.get(`api/proof/signed-url/${id}`);
};

export const getDashboardStats = () => {
    return api.get("api/proofs/dashboard-stats");
}

export const getTopAuthors = () => {
    return api.get("api/proofs/top-authors");
}