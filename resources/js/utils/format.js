import dayjs from "dayjs";

export const formatDate = (date) => {
    return date ? dayjs(date).format("DD/MM/YYYY HH:mm") : "";
};

export const formatStatus = (status) => {
    switch (status) {
        case 'pending':
            return 'Đang chờ duyệt';
        case 'approved':
            return 'Đã duyệt';
        case 'rejected':
            return 'Đã từ chối';
        default:
            return 'Không xác định';
    }
};

export const formatClassStatus = (status) => {
    switch (status) {
        case 'pending':
            return 'bg-warning text-dark';
        case 'approved':
            return 'bg-success text-white';
        case 'rejected':
            return 'bg-danger text-white';
        default:
            return 'bg-secondary text-white';
    }
};