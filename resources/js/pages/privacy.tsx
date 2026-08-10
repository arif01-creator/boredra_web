import { Section } from '@/components/section';
import type { PageContent } from '@/types/models';

type LegalPageProps = {
    page: PageContent | null;
};

export default function Privacy({ page }: LegalPageProps) {
    return (
        <Section tone="white" className="pt-44">
            <p className="label-micro text-moss">Legal</p>
            <h1 className="mt-6 text-[clamp(2.25rem,4.5vw,3.5rem)] font-serif text-charcoal">Privacy Policy</h1>
            <div className="mt-10 max-w-2xl space-y-4 text-sm leading-relaxed whitespace-pre-line text-moss">
                {page?.sections.body}
            </div>
        </Section>
    );
}
