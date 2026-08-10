export type FlashToast = {
    type: 'success' | 'info' | 'warning' | 'error';
    message: string;
};

export type BreadcrumbItem = {
    title: string;
    href?: string;
};
