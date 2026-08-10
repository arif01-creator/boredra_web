import { ProductShowcase } from '@/components/product-showcase';
import { Section } from '@/components/section';
import { useTranslations } from '@/lib/locale';
import type { Product } from '@/types/models';

type ProductsIndexProps = {
    products: Product[];
};

export default function ProductsIndex({ products }: ProductsIndexProps) {
    const t = useTranslations();

    return (
        <>
            <Section tone="forest" className="pt-44 pb-16">
                <p className="label-micro text-gold">{t('products.label')}</p>
                <h1 className="mt-6 max-w-3xl text-[clamp(2.5rem,6vw,5rem)] leading-[1.02] font-serif text-ivory whitespace-pre-line">
                    {t('products.heading')}
                </h1>
            </Section>

            <div className="container-editorial py-4">
                <ProductShowcase products={products} />
            </div>
        </>
    );
}
