import { ArrowUp } from 'lucide-react';
import { useEffect, useState } from 'react';
import { prefersReducedMotion } from '@/lib/gsap';
import { useTranslations } from '@/lib/locale';
import { cn } from '@/lib/utils';

const SHOW_AFTER_PX = 480;

export function BackToTop() {
    const t = useTranslations();
    const [visible, setVisible] = useState(false);

    useEffect(() => {
        function handleScroll() {
            setVisible(window.scrollY > SHOW_AFTER_PX);
        }

        handleScroll();
        window.addEventListener('scroll', handleScroll, { passive: true });

        return () => window.removeEventListener('scroll', handleScroll);
    }, []);

    function scrollToTop() {
        window.scrollTo({ top: 0, behavior: prefersReducedMotion() ? 'auto' : 'smooth' });
    }

    return (
        <button
            type="button"
            onClick={scrollToTop}
            aria-label={t('common.backToTop')}
            aria-hidden={!visible}
            tabIndex={visible ? 0 : -1}
            className={cn(
                'fixed right-5 bottom-5 z-40 flex h-11 w-11 items-center justify-center rounded-full border border-ivory/15 bg-forest-deep text-ivory shadow-lg transition-all duration-300 hover:bg-forest sm:right-8 sm:bottom-8',
                visible ? 'translate-y-0 opacity-100' : 'pointer-events-none translate-y-3 opacity-0',
            )}
        >
            <ArrowUp className="h-4 w-4" aria-hidden="true" />
        </button>
    );
}
