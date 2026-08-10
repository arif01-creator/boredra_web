import { Reveal } from '@/components/reveal';
import { cn } from '@/lib/utils';

type SectionHeadingProps = {
    label?: string | null;
    heading: string;
    description?: string | null;
    align?: 'left' | 'center';
    className?: string;
    tone?: 'dark' | 'light';
};

export function SectionHeading({ label, heading, description, align = 'left', className, tone = 'dark' }: SectionHeadingProps) {
    return (
        <div className={cn('max-w-2xl', align === 'center' && 'mx-auto text-center', className)}>
            {label && (
                <Reveal>
                    <p className={cn('label-micro mb-4', tone === 'dark' ? 'text-moss' : 'text-sage-soft')}>{label}</p>
                </Reveal>
            )}
            <Reveal delay={0.08} as="h2" className="text-[clamp(2.2rem,4.5vw,4rem)] leading-[1.08] font-serif whitespace-pre-line">
                {heading}
            </Reveal>
            {description && (
                <Reveal delay={0.16} as="p" className={cn('mt-6 text-base leading-relaxed sm:text-lg', tone === 'dark' ? 'text-moss' : 'text-sage-soft')}>
                    {description}
                </Reveal>
            )}
        </div>
    );
}
