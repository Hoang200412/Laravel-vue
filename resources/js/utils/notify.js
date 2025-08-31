import { notification } from 'ant-design-vue';
export const notifySuccess = (description) => {
    notification.open({
        type: 'success',
        message: 'Thông báo',
        description:
            description || 'Thành công',
    });
};

export const notifyError = (error) => {
    notification.open({
        type: 'error',
        message: 'Thông báo',
        description:
            error || 'Đã xảy ra lỗi',
    });
};
