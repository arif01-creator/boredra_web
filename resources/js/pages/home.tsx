import { AppLink } from '@/components/app-link';
import { Cta } from '@/components/cta';
import { GlobalMap } from '@/components/global-map';
import { Hero } from '@/components/hero';
import { ImagePlaceholder } from '@/components/image-placeholder';
import { ImageReveal } from '@/components/image-reveal';
import { ProductShowcase } from '@/components/product-showcase';
import { QualityTimeline } from '@/components/quality-timeline';
import { Reveal } from '@/components/reveal';
import { Section } from '@/components/section';
import { SectionHeading } from '@/components/section-heading';
import { Stats } from '@/components/stats';
import { useTranslations } from '@/lib/locale';
import type { CompanyStat, GlobalMarket, PageContent, Product, QualityStage, ResponsibilityItem } from '@/types/models';

type HomeProps = {
    heroImage: string | null;
    intro: PageContent | null;
    about: PageContent | null;
    products: Product[];
    qualityStages: QualityStage[];
    markets: GlobalMarket[];
    stats: CompanyStat[];
    responsibility: { page: PageContent | null; items: ResponsibilityItem[] } | null;
};

export default function Home({ heroImage, intro, about, products, qualityStages, markets, stats, responsibility }: HomeProps) {
    const t = useTranslations();

    return (
        <>
            <Hero image={heroImage} />

            <Section id="introduction" tone="white">
                <div className="grid grid-cols-1 gap-12 lg:grid-cols-12">
                    <div className="lg:col-span-5">
                        <SectionHeading label={intro?.sections.label ?? t('home.whoWeAre')} heading={intro?.sections.heading ?? 'A trusted connection\nbetween quality materials\nand global markets.'} />
                    </div>
                    <div className="lg:col-span-6 lg:col-start-7">
                        <Reveal as="p" delay={0.1} className="text-base leading-relaxed text-moss sm:text-lg">
                            {intro?.sections.body}
                        </Reveal>

                        <Reveal delay={0.2} className="mt-10 grid grid-cols-1 gap-8 border-t border-stone pt-8 sm:grid-cols-3">
                            <div>
                                <p className="label-micro text-gold">{t('home.basedIn')}</p>
                                <p className="mt-2 text-sm text-charcoal">{t('common.dhakaBangladesh')}</p>
                            </div>
                            <div>
                                <p className="label-micro text-gold">{t('home.focus')}</p>
                                <p className="mt-2 text-sm text-charcoal">{t('home.focusValue')}</p>
                            </div>
                            <div>
                                <p className="label-micro text-gold">{t('home.market')}</p>
                                <p className="mt-2 text-sm text-charcoal">{t('home.marketValue')}</p>
                            </div>
                        </Reveal>
                    </div>
                </div>
            </Section>

            <Section tone="ivory">
                <div className="grid grid-cols-1 items-center gap-14 lg:grid-cols-2 lg:gap-20">
                    <ImageReveal className="aspect-[4/5] w-full rounded-sm">
                        <ImagePlaceholder src={null} alt={t('placeholder.craftsmanship')} />
                    </ImageReveal>

                    <div>
                        <SectionHeading label={t('home.aboutLabel')} heading={about?.sections.heading ?? 'Built on Quality.\nDriven by Trust.'} description={about?.sections.body} />
                        <Reveal delay={0.25} className="mt-8">
                            <AppLink href="/about" className="group inline-flex items-center gap-2 text-xs font-medium tracking-[0.15em] text-forest-deep uppercase">
                                {t('common.discoverCompany')}
                                <span className="transition-transform duration-300 group-hover:translate-x-1.5">→</span>
                            </AppLink>
                        </Reveal>
                    </div>
                </div>
            </Section>

            <Section tone="white" className="!pb-0">
                <SectionHeading label={t('home.materialsLabel')} heading={t('home.materialsHeading')} />
            </Section>
            <div className="container-editorial pb-24 sm:pb-28 lg:pb-36">
                <ProductShowcase products={products} />
            </div>

            <QualityTimeline stages={qualityStages} />

            <Section tone="white">
                <SectionHeading label={t('home.globalReachLabel')} heading={t('home.globalReachHeading')} />
                <Reveal delay={0.2} className="mt-14">
                    <GlobalMap markets={markets} />
                </Reveal>
                {markets.length === 0 && (
                    <p className="mt-6 text-sm text-moss">{t('common.emptyDestinations')}</p>
                )}
            </Section>

            {stats.length > 0 && (
                <Section tone="ivory">
                    <Stats stats={stats} />
                </Section>
            )}

            {responsibility && (
                <Section tone="white">
                    <SectionHeading label={t('home.responsibleLabel')} heading={responsibility.page?.sections.heading ?? 'Responsible\nby Approach.'} />
                    <div className="mt-14 grid grid-cols-1 gap-x-10 gap-y-8 sm:grid-cols-2 lg:grid-cols-3">
                        {responsibility.items.map((item, index) => (
                            <Reveal key={item.id} delay={index * 0.06}>
                                <p className="label-micro text-gold">{String(index + 1).padStart(2, '0')}</p>
                                <p className="mt-3 font-serif text-xl text-charcoal">{item.title}</p>
                                {item.description && <p className="mt-2 text-sm text-moss">{item.description}</p>}
                            </Reveal>
                        ))}
                    </div>
                </Section>
            )}

            <Cta
                heading={t('home.ctaHeading')}
                description={t('home.ctaDescription')}
                actionLabel={t('common.sendInquiry')}
                actionHref="/contact"
            />
        </>
    );
}
