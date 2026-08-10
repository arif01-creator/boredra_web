import { MagneticButton } from '@/components/magnetic-button';
import { Section } from '@/components/section';
import { SectionHeading } from '@/components/section-heading';

type CtaProps = {
    label?: string;
    heading: string;
    description?: string;
    actionLabel: string;
    actionHref: string;
};

export function Cta({ label = 'GET IN TOUCH', heading, description, actionLabel, actionHref }: CtaProps) {
    return (
        <Section tone="forest">
            <div className="flex flex-col items-start justify-between gap-10 lg:flex-row lg:items-end">
                <SectionHeading label={label} heading={heading} description={description} tone="light" className="max-w-xl" />
                <MagneticButton href={actionHref} variant="solid">
                    {actionLabel} →
                </MagneticButton>
            </div>
        </Section>
    );
}
