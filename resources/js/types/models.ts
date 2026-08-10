export type SeoProps = {
    title: string;
    description: string;
    canonical: string;
    ogTitle: string;
    ogDescription: string;
    ogImage: string | null;
    robots: string;
    jsonLd: Record<string, unknown>[];
};

export type ProductCategory = {
    id: number;
    name: string;
    slug: string;
    description: string | null;
    image: string | null;
};

export type Product = {
    id: number;
    name: string;
    slug: string;
    short_description: string | null;
    long_description: string | null;
    featured_image: string | null;
    specifications: Record<string, string | null> | null;
    applications: string[] | null;
    category: ProductCategory | null;
};

export type QualityStage = {
    id: number;
    title: string;
    description: string | null;
    image: string | null;
};

export type GlobalMarket = {
    id: number;
    country: string;
    description: string | null;
    latitude: number;
    longitude: number;
};

export type CompanyStat = {
    id: number;
    label: string;
    value: string;
};

export type ResponsibilityItem = {
    id: number;
    title: string;
    description: string | null;
    icon: string | null;
};

export type PageContent = {
    title: string;
    sections: Record<string, string | null>;
};

export type SiteSettings = {
    company_name: string | null;
    company_address: string | null;
    company_phone: string | null;
    company_email: string | null;
    company_profile_pdf: string | null;
    social_facebook: string | null;
    social_linkedin: string | null;
    social_instagram: string | null;
    responsibility_section_enabled: string | null;
};
