import type { ElementType, ReactNode } from 'react';
import { cn } from '@/lib/utils';

type SectionProps = {
    children: ReactNode;
    className?: string;
    tone?: 'ivory' | 'forest' | 'white';
    as?: ElementType;
    id?: string;
};

const tones: Record<NonNullable<SectionProps['tone']>, string> = {
    ivory: 'bg-ivory text-charcoal',
    forest: 'bg-forest-deep text-ivory',
    white: 'bg-white-warm text-charcoal',
};

export function Section({ children, className, tone = 'white', as: Tag = 'section', id }: SectionProps) {
    return (
        <Tag id={id} className={cn('py-24 sm:py-28 lg:py-36', tones[tone], className)}>
            <div className="container-editorial">{children}</div>
        </Tag>
    );
}
