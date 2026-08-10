import { Link } from '@inertiajs/react';
import { ImagePlaceholder } from '@/components/image-placeholder';
import { ImageReveal } from '@/components/image-reveal';
import { Reveal } from '@/components/reveal';
import { cn } from '@/lib/utils';
import type { Product } from '@/types/models';

type ProductShowcaseProps = {
    products: Product[];
};

export function ProductShowcase({ products }: ProductShowcaseProps) {
    return (
        <div className="divide-y divide-stone">
            {products.map((product, index) => (
                <Link
                    key={product.id}
                    href={`/products/${product.slug}`}
                    className={cn(
                        'group grid grid-cols-1 items-center gap-10 py-16 lg:grid-cols-2 lg:gap-16 lg:py-24',
                        index % 2 === 1 && 'lg:[&>*:first-child]:order-2',
                    )}
                >
                    <ImageReveal className="aspect-[4/3] w-full rounded-sm">
                        <div className="h-full w-full transition-transform duration-700 ease-out group-hover:scale-105">
                            <ImagePlaceholder src={product.featured_image} alt={product.name} />
                        </div>
                    </ImageReveal>

                    <Reveal>
                        <span className="label-micro text-gold">{String(index + 1).padStart(2, '0')}</span>
                        <h3 className="mt-4 text-[clamp(1.8rem,3vw,2.75rem)] leading-tight font-serif text-charcoal">
                            {product.name}
                        </h3>
                        <p className="mt-4 max-w-md text-base leading-relaxed text-moss">{product.short_description}</p>
                        <span className="mt-7 inline-flex items-center gap-2 text-xs font-medium tracking-[0.15em] text-forest-deep uppercase">
                            Explore
                            <span className="transition-transform duration-300 group-hover:translate-x-1.5">→</span>
                        </span>
                    </Reveal>
                </Link>
            ))}
        </div>
    );
}
