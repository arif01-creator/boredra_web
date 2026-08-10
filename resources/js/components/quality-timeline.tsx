import { useEffect, useRef, useState } from 'react';
import { ImagePlaceholder } from '@/components/image-placeholder';
import { ensureGsap, prefersReducedMotion } from '@/lib/gsap';
import { cn } from '@/lib/utils';
import type { QualityStage } from '@/types/models';

type QualityTimelineProps = {
    stages: QualityStage[];
};

export function QualityTimeline({ stages }: QualityTimelineProps) {
    const containerRef = useRef<HTMLDivElement>(null);
    const [active, setActive] = useState(0);
    const [progress, setProgress] = useState(0);
    const reduced = prefersReducedMotion();

    useEffect(() => {
        const el = containerRef.current;

        if (!el || reduced || stages.length === 0) {
return;
}

        const { gsap, ScrollTrigger } = ensureGsap();

        const trigger = ScrollTrigger.create({
            trigger: el,
            start: 'top top',
            end: `+=${stages.length * 420}`,
            pin: true,
            scrub: 0.6,
            onUpdate: (self) => {
                setProgress(self.progress);
                setActive(Math.min(stages.length - 1, Math.floor(self.progress * stages.length)));
            },
        });

        return () => {
            trigger.kill();
            gsap.set(el, { clearProps: 'all' });
        };
    }, [reduced, stages.length]);

    if (stages.length === 0) {
return null;
}

    return (
        <div ref={containerRef} className="relative flex min-h-screen items-center overflow-hidden bg-forest-deep text-ivory">
            <div className="container-editorial grid w-full grid-cols-1 gap-14 py-20 lg:grid-cols-2 lg:gap-20">
                <div>
                    <p className="label-micro mb-8 text-gold">Quality Is A Process</p>

                    <div className="relative pl-8">
                        <div className="absolute top-0 bottom-0 left-0 w-px bg-ivory/15">
                            <div
                                className="w-full bg-gold transition-[height] duration-150"
                                style={{ height: `${(reduced ? 1 : progress) * 100}%` }}
                            />
                        </div>

                        <ol className="space-y-6">
                            {stages.map((stage, index) => (
                                <li
                                    key={stage.id}
                                    className={cn(
                                        'transition-colors duration-300',
                                        index === active || reduced ? 'text-ivory' : 'text-ivory/35',
                                    )}
                                >
                                    <span className="label-micro mr-3 text-gold">{String(index + 1).padStart(2, '0')}</span>
                                    <span className="text-xl font-serif sm:text-2xl">{stage.title}</span>
                                    {(index === active || reduced) && stage.description && (
                                        <p className="mt-2 max-w-md text-sm leading-relaxed text-sage-soft">{stage.description}</p>
                                    )}
                                </li>
                            ))}
                        </ol>
                    </div>
                </div>

                <div className="relative aspect-[4/3] overflow-hidden rounded-sm lg:aspect-auto lg:h-[28rem]">
                    {stages.map((stage, index) => (
                        <div
                            key={stage.id}
                            className={cn(
                                'absolute inset-0 transition-opacity duration-500',
                                index === active || reduced ? 'opacity-100' : 'opacity-0',
                            )}
                        >
                            <ImagePlaceholder src={stage.image} alt={stage.title} />
                        </div>
                    ))}
                </div>
            </div>
        </div>
    );
}
