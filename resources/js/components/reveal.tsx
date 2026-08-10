import { useEffect, useRef   } from 'react';
import type {ElementType, ReactNode} from 'react';
import { ensureGsap, prefersReducedMotion } from '@/lib/gsap';
import { cn } from '@/lib/utils';

type RevealProps = {
    children: ReactNode;
    className?: string;
    as?: ElementType;
    y?: number;
    delay?: number;
    duration?: number;
};

export function Reveal({ children, className, as: Tag = 'div', y = 28, delay = 0, duration = 1 }: RevealProps) {
    const ref = useRef<HTMLElement>(null);

    useEffect(() => {
        const el = ref.current;

        if (!el) {
return;
}

        if (prefersReducedMotion()) {
            el.style.opacity = '1';
            el.style.transform = 'none';

            return;
        }

        const { gsap, ScrollTrigger } = ensureGsap();

        const ctx = gsap.context(() => {
            gsap.fromTo(
                el,
                { opacity: 0, y },
                {
                    opacity: 1,
                    y: 0,
                    duration,
                    delay,
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: el,
                        start: 'top 88%',
                        once: true,
                    },
                },
            );
        }, el);

        return () => {
            ctx.revert();
            ScrollTrigger.getAll().forEach((trigger) => {
                if (trigger.trigger === el) {
trigger.kill();
}
            });
        };
    }, [y, delay, duration]);

    const Component = Tag as ElementType;

    return (
        <Component ref={ref} className={cn('opacity-0', className)}>
            {children}
        </Component>
    );
}
