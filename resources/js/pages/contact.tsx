import { InquiryForm } from '@/components/inquiry-form';
import { Section } from '@/components/section';
import { useTranslations } from '@/lib/locale';

type ContactProps = {
    productOptions: string[];
};

export default function Contact({ productOptions }: ContactProps) {
    const t = useTranslations();

    return (
        <Section tone="forest" className="pt-44">
            <div className="grid grid-cols-1 gap-16 lg:grid-cols-2 lg:gap-24">
                <div>
                    <p className="label-micro text-gold">{t('contactPage.label')}</p>
                    <h1 className="mt-6 max-w-lg text-[clamp(2.5rem,5.5vw,4.5rem)] leading-[1.03] font-serif text-ivory">
                        {t('contactPage.heading1')}
                        <br />
                        {t('contactPage.heading2')}
                    </h1>
                    <p className="mt-6 max-w-md text-sage-soft">{t('contactPage.body')}</p>
                </div>

                <InquiryForm productOptions={productOptions} tone="dark" />
            </div>
        </Section>
    );
}
