import { useEffect, useRef } from 'react';
import { ImagePlaceholder } from '@/components/image-placeholder';
import { MagneticButton } from '@/components/magnetic-button';
import { ensureGsap, prefersReducedMotion } from '@/lib/gsap';
import { useTranslations } from '@/lib/locale';

type HeroProps = {
    image?: string | null;
};

export function Hero({ image }: HeroProps) {
    const t = useTranslations();
    const imgRef = useRef<HTMLDivElement>(null);
    const overlayRef = useRef<HTMLDivElement>(null);
    const labelRef = useRef<HTMLParagraphElement>(null);
    const headingRef = useRef<HTMLHeadingElement>(null);
    const bodyRef = useRef<HTMLParagraphElement>(null);
    const ctaRef = useRef<HTMLDivElement>(null);

    useEffect(() => {
        if (prefersReducedMotion()) {
return;
}

        const { gsap } = ensureGsap();

        const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });

        tl.fromTo(imgRef.current, { scale: 1.06 }, { scale: 1, duration: 1.8 }, 0)
            .fromTo(overlayRef.current, { opacity: 0 }, { opacity: 1, duration: 1 }, 0)
            .fromTo(labelRef.current, { opacity: 0, y: 16 }, { opacity: 1, y: 0, duration: 0.8 }, 0.4)
            .fromTo(headingRef.current, { opacity: 0, y: 28 }, { opacity: 1, y: 0, duration: 1 }, 0.55)
            .fromTo(bodyRef.current, { opacity: 0, y: 16 }, { opacity: 1, y: 0, duration: 0.8 }, 0.8)
            .fromTo(ctaRef.current, { opacity: 0, y: 12 }, { opacity: 1, y: 0, duration: 0.7 }, 0.95);
    }, []);

    return (
        <section className="relative flex min-h-[100svh] items-end overflow-hidden bg-forest-deep">
            <div ref={imgRef} className="absolute inset-0">
                <ImagePlaceholder src={image} alt={t('hero.altText')} label={t('hero.placeholderLabel')} />
            </div>
            <div ref={overlayRef} className="absolute inset-0 bg-gradient-to-t from-forest-deep via-forest-deep/50 to-forest-deep/20" />

            <div className="container-editorial relative z-10 pb-24 pt-40 sm:pb-32">
                <p ref={labelRef} className="label-micro text-gold">
                    {t('hero.label1')}
                    <br className="sm:hidden" /> {t('hero.label2')}
                </p>

                <h1 ref={headingRef} className="mt-6 max-w-4xl text-[clamp(2.75rem,7vw,6.5rem)] leading-[0.98] font-serif text-ivory">
                    {t('hero.heading1')}
                    <br />
                    {t('hero.heading2')}
                </h1>

                <p ref={bodyRef} className="mt-8 max-w-xl text-base leading-relaxed text-sage-soft sm:text-lg">
                    {t('hero.body')}
                </p>

                <div ref={ctaRef} className="mt-10 flex flex-wrap items-center gap-4">
                    <MagneticButton href="/products" variant="solid">
                        {t('hero.exploreProducts')}
                    </MagneticButton>
                    <MagneticButton href="/contact" variant="outline">
                        {t('common.contactUs')}
                    </MagneticButton>
                </div>
            </div>

            <a
                href="#introduction"
                className="absolute bottom-8 left-1/2 z-10 hidden -translate-x-1/2 flex-col items-center gap-2 text-[10px] tracking-[0.25em] text-sage-soft uppercase sm:flex"
            >
                {t('hero.scrollToExplore')}
                <span className="h-8 w-px animate-pulse bg-sage-soft/60" />
            </a>
        </section>
    );
}
