import { Cta } from '@/components/cta';
import { ImagePlaceholder } from '@/components/image-placeholder';
import { ImageReveal } from '@/components/image-reveal';
import { Reveal } from '@/components/reveal';
import { Section } from '@/components/section';
import { Stats } from '@/components/stats';
import { useTranslations } from '@/lib/locale';
import type { CompanyStat, PageContent } from '@/types/models';

type AboutProps = {
    about: PageContent | null;
    stats: CompanyStat[];
};

export default function About({ about, stats }: AboutProps) {
    const t = useTranslations();

    return (
        <>
            <Section tone="forest" className="pt-44">
                <p className="label-micro text-gold">{t('about.label')}</p>
                <h1 className="mt-6 max-w-3xl text-[clamp(2.5rem,6vw,5rem)] leading-[1.02] font-serif text-ivory whitespace-pre-line">
                    {about?.sections.heading ?? 'Built on Quality.\nDriven by Trust.'}
                </h1>
            </Section>

            <Section tone="white">
                <div className="grid grid-cols-1 gap-14 lg:grid-cols-2 lg:gap-20">
                    <ImageReveal className="aspect-[4/5] w-full rounded-sm lg:order-2">
                        <ImagePlaceholder src={null} alt={t('placeholder.operations')} />
                    </ImageReveal>

                    <div className="lg:order-1">
                        <Reveal as="p" className="text-base leading-relaxed text-moss sm:text-lg">
                            {about?.sections.body}
                        </Reveal>

                        <Reveal delay={0.15} className="mt-10 space-y-5 border-t border-stone pt-8 text-sm text-moss">
                            <p>— {t('about.bullet1')}</p>
                            <p>— {t('about.bullet2')}</p>
                            <p>— {t('about.bullet3')}</p>
                            <p>— {t('about.bullet4')}</p>
                        </Reveal>
                    </div>
                </div>

                {stats.length > 0 && (
                    <div className="mt-20">
                        <Stats stats={stats} />
                    </div>
                )}
            </Section>

            <Cta
                heading={t('about.ctaHeading')}
                actionLabel={t('nav.companyProfile')}
                actionHref="/company-profile"
            />
        </>
    );
}
