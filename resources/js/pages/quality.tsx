import { Cta } from '@/components/cta';
import { QualityTimeline } from '@/components/quality-timeline';
import { Section } from '@/components/section';
import { useTranslations } from '@/lib/locale';
import type { QualityStage } from '@/types/models';

type QualityProps = {
    stages: QualityStage[];
};

export default function Quality({ stages }: QualityProps) {
    const t = useTranslations();

    return (
        <>
            <Section tone="forest" className="pt-44 pb-20">
                <p className="label-micro text-gold">{t('qualityPage.label')}</p>
                <h1 className="mt-6 max-w-2xl text-[clamp(2.5rem,6vw,5rem)] leading-[1.02] font-serif text-ivory">
                    {t('qualityPage.heading1')}
                    <br />
                    {t('qualityPage.heading2')}
                </h1>
            </Section>

            <QualityTimeline stages={stages} />

            <Cta
                heading={t('qualityPage.ctaHeading')}
                actionLabel={t('common.contactUs')}
                actionHref="/contact"
            />
        </>
    );
}
