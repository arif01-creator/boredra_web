import { Section } from '@/components/section';
import { useTranslations } from '@/lib/locale';
import type { PageContent } from '@/types/models';

type LegalPageProps = {
    page: PageContent | null;
};

export default function Terms({ page }: LegalPageProps) {
    const t = useTranslations();

    return (
        <Section tone="white" className="pt-44">
            <p className="label-micro text-moss">{t('legal.label')}</p>
            <h1 className="mt-6 text-[clamp(2.25rem,4.5vw,3.5rem)] font-serif text-charcoal">{t('legal.termsTitle')}</h1>
            <div className="mt-10 max-w-2xl space-y-4 text-sm leading-relaxed whitespace-pre-line text-moss">
                {page?.sections.body}
            </div>
        </Section>
    );
}
