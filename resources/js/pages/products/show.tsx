import { Breadcrumbs } from '@/components/breadcrumbs';
import { Cta } from '@/components/cta';
import { ImagePlaceholder } from '@/components/image-placeholder';
import { ImageReveal } from '@/components/image-reveal';
import { ProductShowcase } from '@/components/product-showcase';
import { Reveal } from '@/components/reveal';
import { Section } from '@/components/section';
import { useTranslations } from '@/lib/locale';
import type { Product } from '@/types/models';

type ProductShowProps = {
    product: Product & { images?: { id: number; path: string; alt_text: string | null }[] };
    related: Product[];
};

export default function ProductShow({ product, related }: ProductShowProps) {
    const t = useTranslations();
    const specs = Object.entries(product.specifications ?? {}).filter(([, value]) => Boolean(value));
    const applications = product.applications ?? [];

    return (
        <>
            <Section tone="forest" className="pt-40 pb-16">
                <Breadcrumbs
                    breadcrumbs={[
                        { title: t('products.breadcrumb'), href: '/products' },
                        { title: product.name },
                    ]}
                />
                <p className="label-micro mt-6 text-gold">{product.category?.name}</p>
                <h1 className="mt-4 max-w-3xl text-[clamp(2.25rem,5.5vw,4.5rem)] leading-[1.05] font-serif text-ivory">{product.name}</h1>
            </Section>

            <Section tone="white">
                <div className="grid grid-cols-1 gap-14 lg:grid-cols-2 lg:gap-20">
                    <ImageReveal className="aspect-[4/5] w-full rounded-sm">
                        <ImagePlaceholder src={product.featured_image} alt={product.name} />
                    </ImageReveal>

                    <div>
                        <p className="label-micro text-moss">{t('products.overview')}</p>
                        <Reveal as="p" className="mt-4 text-base leading-relaxed text-charcoal sm:text-lg">
                            {product.long_description ?? product.short_description}
                        </Reveal>

                        {applications.length > 0 && (
                            <div className="mt-10 border-t border-stone pt-8">
                                <p className="label-micro text-moss">{t('products.applications')}</p>
                                <ul className="mt-4 space-y-2 text-sm text-charcoal">
                                    {applications.map((item) => (
                                        <li key={item}>— {item}</li>
                                    ))}
                                </ul>
                            </div>
                        )}

                        {specs.length > 0 && (
                            <div className="mt-10 border-t border-stone pt-8">
                                <p className="label-micro text-moss">{t('products.specifications')}</p>
                                <dl className="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                                    {specs.map(([key, value]) => (
                                        <div key={key}>
                                            <dt className="text-xs tracking-wide text-moss uppercase">{key}</dt>
                                            <dd className="mt-1 text-sm text-charcoal">{value}</dd>
                                        </div>
                                    ))}
                                </dl>
                            </div>
                        )}
                    </div>
                </div>

                {product.images && product.images.length > 0 && (
                    <div className="mt-20 grid grid-cols-2 gap-4 sm:grid-cols-3">
                        {product.images.map((image) => (
                            <div key={image.id} className="aspect-square overflow-hidden rounded-sm">
                                <ImagePlaceholder src={image.path} alt={image.alt_text ?? product.name} />
                            </div>
                        ))}
                    </div>
                )}
            </Section>

            <Cta
                heading={`${t('products.interestedIn')}\n${product.name}?`}
                description={t('products.ctaDescription')}
                actionLabel={t('common.sendInquiry')}
                actionHref="/contact"
            />

            {related.length > 0 && (
                <Section tone="white">
                    <p className="label-micro text-moss">{t('products.relatedMaterials')}</p>
                    <div className="mt-6">
                        <ProductShowcase products={related} />
                    </div>
                </Section>
            )}
        </>
    );
}
