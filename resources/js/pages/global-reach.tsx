import { Cta } from '@/components/cta';
import { GlobalMap } from '@/components/global-map';
import { Reveal } from '@/components/reveal';
import { Section } from '@/components/section';
import { useTranslations } from '@/lib/locale';
import type { GlobalMarket } from '@/types/models';

type GlobalReachProps = {
    markets: GlobalMarket[];
};

export default function GlobalReach({ markets }: GlobalReachProps) {
    const t = useTranslations();

    return (
        <>
            <Section tone="forest" className="pt-44 pb-16">
                <p className="label-micro text-gold">{t('globalReachPage.label')}</p>
                <h1 className="mt-6 max-w-3xl text-[clamp(2.5rem,6vw,5rem)] leading-[1.02] font-serif text-ivory">
                    {t('globalReachPage.heading1')}
                    <br />
                    {t('globalReachPage.heading2')}
                </h1>
            </Section>

            <Section tone="white">
                <Reveal>
                    <GlobalMap markets={markets} />
                </Reveal>

                {markets.length === 0 ? (
                    <p className="mt-8 text-sm text-moss">{t('common.emptyDestinations')}</p>
                ) : (
                    <div className="mt-16 grid grid-cols-1 gap-8 border-t border-stone pt-10 sm:grid-cols-2 lg:grid-cols-3">
                        {markets.map((market) => (
                            <Reveal key={market.id}>
                                <p className="font-serif text-lg text-charcoal">{market.country}</p>
                                {market.description && <p className="mt-2 text-sm text-moss">{market.description}</p>}
                            </Reveal>
                        ))}
                    </div>
                )}
            </Section>

            <Cta
                heading={t('globalReachPage.ctaHeading')}
                actionLabel={t('common.sendInquiry')}
                actionHref="/contact"
            />
        </>
    );
}
