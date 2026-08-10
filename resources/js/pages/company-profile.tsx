import { MagneticButton } from '@/components/magnetic-button';
import { Reveal } from '@/components/reveal';
import { Section } from '@/components/section';
import { useTranslations } from '@/lib/locale';
import type { PageContent } from '@/types/models';

type CompanyProfileProps = {
    page: PageContent | null;
    settings: {
        company_email: string | null;
        company_phone: string | null;
        company_profile_pdf: string | null;
    };
};

export default function CompanyProfile({ page, settings }: CompanyProfileProps) {
    const t = useTranslations();
    const s = page?.sections ?? {};

    return (
        <>
            <Section tone="forest" className="pt-44 pb-20">
                <p className="label-micro text-gold">{t('companyProfile.label')}</p>
                <h1 className="mt-6 max-w-2xl text-[clamp(2.5rem,6vw,5rem)] leading-[1.02] font-serif text-ivory">
                    {s.legal_name ?? 'Borendra International'}
                </h1>
                <p className="mt-4 text-sage-soft">{s.business_type ?? t('companyProfile.defaultBusinessType')}</p>
            </Section>

            <Section tone="white">
                <div className="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-4">
                    <Reveal>
                        <p className="label-micro text-moss">{t('companyProfile.legalName')}</p>
                        <p className="mt-2 font-serif text-lg text-charcoal">{s.legal_name ?? 'Borendra International'}</p>
                    </Reveal>
                    <Reveal delay={0.06}>
                        <p className="label-micro text-moss">{t('companyProfile.businessType')}</p>
                        <p className="mt-2 font-serif text-lg text-charcoal">{s.business_type ?? t('companyProfile.defaultBusinessType')}</p>
                    </Reveal>
                    <Reveal delay={0.12}>
                        <p className="label-micro text-moss">{t('companyProfile.address')}</p>
                        <p className="mt-2 font-serif text-lg text-charcoal">{s.address ?? t('common.dhakaBangladesh')}</p>
                    </Reveal>
                    <Reveal delay={0.18}>
                        <p className="label-micro text-moss">{t('companyProfile.contact')}</p>
                        <p className="mt-2 font-serif text-lg text-charcoal">{settings.company_email ?? '—'}</p>
                        <p className="text-sm text-moss">{settings.company_phone ?? ''}</p>
                    </Reveal>
                </div>

                {settings.company_profile_pdf && (
                    <Reveal delay={0.25} className="mt-14">
                        <MagneticButton href={settings.company_profile_pdf} variant="dark">
                            {t('companyProfile.download')}
                        </MagneticButton>
                    </Reveal>
                )}
            </Section>
        </>
    );
}
