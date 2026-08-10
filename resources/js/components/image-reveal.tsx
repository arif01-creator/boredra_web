import { useEffect, useRef, type ReactNode } from 'react';
import { cn } from '@/lib/utils';
import { ensureGsap, prefersReducedMotion } from '@/lib/gsap';

type ImageRevealProps = {
    className?: string;
    imgClassName?: string;
    children?: ReactNode;
};

/**
 * Wraps an <img> (passed as children) in a masked container that reveals
 * the image on scroll while the image itself slow-zooms from 1.08 to 1.
 */
export function ImageReveal({ className, imgClassName, children }: ImageRevealProps) {
    const wrapRef = useRef<HTMLDivElement>(null);
    const imgRef = useRef<HTMLDivElement>(null);

    useEffect(() => {
        const wrap = wrapRef.current;
        const inner = imgRef.current;
        if (!wrap || !inner) return;

        if (prefersReducedMotion()) {
            inner.style.transform = 'none';
            inner.style.clipPath = 'inset(0 0 0 0)';
            return;
        }

        const { gsap, ScrollTrigger } = ensureGsap();

        const ctx = gsap.context(() => {
            gsap.fromTo(
                wrap,
                { clipPath: 'inset(0 0 100% 0)' },
                {
                    clipPath: 'inset(0 0 0% 0)',
                    duration: 1.1,
                    ease: 'power3.out',
                    scrollTrigger: { trigger: wrap, start: 'top 85%', once: true },
                },
            );
            gsap.fromTo(
                inner,
                { scale: 1.12 },
                {
                    scale: 1,
                    duration: 1.4,
                    ease: 'power2.out',
                    scrollTrigger: { trigger: wrap, start: 'top 85%', once: true },
                },
            );
        }, wrap);

        return () => {
            ctx.revert();
            ScrollTrigger.getAll().forEach((trigger) => {
                if (trigger.trigger === wrap) trigger.kill();
            });
        };
    }, []);

    return (
        <div ref={wrapRef} className={cn('overflow-hidden', className)}>
            <div ref={imgRef} className={cn('h-full w-full', imgClassName)}>
                {children}
            </div>
        </div>
    );
}
