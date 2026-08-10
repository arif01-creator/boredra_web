import type { SiteSettings } from '@/types/models';

declare module '@inertiajs/core' {
    export interface InertiaConfig {
        sharedPageProps: {
            name: string;
            settings: SiteSettings;
            [key: string]: unknown;
        };
    }
}
