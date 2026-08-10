import { Cta } from '@/components/cta';
import { QualityTimeline } from '@/components/quality-timeline';
import { Section } from '@/components/section';
import type { QualityStage } from '@/types/models';

type QualityProps = {
    stages: QualityStage[];
};

export default function Quality({ stages }: QualityProps) {
    return (
        <>
            <Section tone="forest" className="pt-44 pb-20">
                <p className="label-micro text-gold">Quality &amp; Process</p>
                <h1 className="mt-6 max-w-2xl text-[clamp(2.5rem,6vw,5rem)] leading-[1.02] font-serif text-ivory">
                    Quality is
                    <br />a process.
                </h1>
            </Section>

            <QualityTimeline stages={stages} />

            <Cta
                heading={'Questions about\nour process?'}
                actionLabel="Contact Us"
                actionHref="/contact"
            />
        </>
    );
}
