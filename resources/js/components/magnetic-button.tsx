import { Link  } from '@inertiajs/react';
import type {InertiaLinkProps} from '@inertiajs/react';
import { useRef  } from 'react';
import type {ReactNode} from 'react';
import { ensureGsap, isTouchDevice, prefersReducedMotion } from '@/lib/gsap';
import { useLocale, withLocale } from '@/lib/locale';
import { cn } from '@/lib/utils';

type MagneticButtonProps = {
    href?: InertiaLinkProps['href'];
    onClick?: () => void;
    type?: 'button' | 'submit';
    variant?: 'solid' | 'outline' | 'ghost' | 'dark';
    className?: string;
    children: ReactNode;
    disabled?: boolean;
};

const variants: Record<NonNullable<MagneticButtonProps['variant']>, string> = {
    solid: 'bg-ivory text-forest-deep hover:bg-white',
    outline: 'border border-ivory/40 text-ivory hover:border-ivory hover:bg-ivory/10',
    ghost: 'text-ivory hover:text-gold',
    dark: 'bg-forest-deep text-ivory hover:bg-forest',
};

export function MagneticButton({ href, onClick, type = 'button', variant = 'solid', className, children, disabled }: MagneticButtonProps) {
    const ref = useRef<HTMLAnchorElement & HTMLButtonElement>(null);
    const locale = useLocale();
    const resolvedHref = typeof href === 'string' ? withLocale(locale, href) : href;

    function handleMouseMove(event: React.MouseEvent) {
        if (isTouchDevice() || prefersReducedMotion()) {
return;
}

        const el = ref.current;

        if (!el) {
return;
}

        const rect = el.getBoundingClientRect();
        const relX = event.clientX - rect.left - rect.width / 2;
        const relY = event.clientY - rect.top - rect.height / 2;

        const { gsap } = ensureGsap();
        gsap.to(el, { x: relX * 0.25, y: relY * 0.35, duration: 0.4, ease: 'power2.out' });
    }

    function handleMouseLeave() {
        const el = ref.current;

        if (!el) {
return;
}

        const { gsap } = ensureGsap();
        gsap.to(el, { x: 0, y: 0, duration: 0.5, ease: 'elastic.out(1, 0.4)' });
    }

    const classes = cn(
        'group inline-flex items-center justify-center gap-2 rounded-full px-7 py-3.5 text-xs font-medium tracking-[0.15em] uppercase transition-colors duration-300',
        variants[variant],
        disabled && 'pointer-events-none opacity-50',
        className,
    );

    const content = <span className="inline-flex items-center gap-2">{children}</span>;

    if (resolvedHref) {
        return (
            <Link
                ref={ref}
                href={resolvedHref}
                onMouseMove={handleMouseMove}
                onMouseLeave={handleMouseLeave}
                className={classes}
            >
                {content}
            </Link>
        );
    }

    return (
        <button
            ref={ref}
            type={type}
            onClick={onClick}
            disabled={disabled}
            onMouseMove={handleMouseMove}
            onMouseLeave={handleMouseLeave}
            className={classes}
        >
            {content}
        </button>
    );
}
