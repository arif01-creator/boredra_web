import { useEffect, useState } from 'react';
import { AppLink } from '@/components/app-link';
import { LocaleSwitcher } from '@/components/locale-switcher';
import { useTranslations } from '@/lib/locale';
import { cn } from '@/lib/utils';

export function SiteHeader() {
    const t = useTranslations();
    const [scrolled, setScrolled] = useState(false);
    const [menuOpen, setMenuOpen] = useState(false);

    const NAV = [
        { label: t('nav.home'), href: '/' },
        { label: t('nav.about'), href: '/about' },
        { label: t('nav.products'), href: '/products' },
        { label: t('nav.quality'), href: '/quality' },
        { label: t('nav.globalReach'), href: '/global-reach' },
        { label: t('nav.contact'), href: '/contact' },
    ];

    useEffect(() => {
        function onScroll() {
            setScrolled(window.scrollY > 24);
        }
        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });

        return () => window.removeEventListener('scroll', onScroll);
    }, []);

    useEffect(() => {
        document.body.style.overflow = menuOpen ? 'hidden' : '';

        return () => {
            document.body.style.overflow = '';
        };
    }, [menuOpen]);

    return (
        <header
            className={cn(
                'fixed inset-x-0 top-0 z-50 transition-all duration-500',
                scrolled || menuOpen ? 'border-b border-ivory/10 bg-forest-deep/90 backdrop-blur-md' : 'bg-transparent',
            )}
        >
            <div className="container-editorial flex h-20 items-center justify-between">
                <AppLink href="/" className="flex flex-col leading-none text-ivory" onClick={() => setMenuOpen(false)}>
                    <span className="text-sm font-medium tracking-[0.25em] uppercase">Borendra</span>
                    <span className="text-[10px] tracking-[0.3em] text-sage-soft uppercase">International</span>
                </AppLink>

                <nav className="hidden items-center gap-9 lg:flex">
                    {NAV.map((item) => (
                        <AppLink
                            key={item.href}
                            href={item.href}
                            className="group relative text-xs font-medium tracking-[0.12em] text-ivory/85 uppercase transition-colors hover:text-ivory"
                        >
                            {item.label}
                            <span className="absolute -bottom-1.5 left-0 h-px w-0 bg-gold transition-all duration-300 group-hover:w-full" />
                        </AppLink>
                    ))}
                </nav>

                <div className="hidden items-center gap-6 lg:flex">
                    <LocaleSwitcher />
                    <AppLink
                        href="/contact"
                        className="rounded-full border border-ivory/30 px-5 py-2.5 text-xs font-medium tracking-[0.15em] text-ivory uppercase transition hover:border-gold hover:text-gold"
                    >
                        {t('nav.inquire')}
                    </AppLink>
                </div>

                <button
                    type="button"
                    aria-label="Toggle navigation"
                    onClick={() => setMenuOpen((v) => !v)}
                    className="flex h-11 w-11 flex-col items-center justify-center gap-1.5 lg:hidden"
                >
                    <span className={cn('h-px w-6 bg-ivory transition-transform', menuOpen && 'translate-y-[3.5px] rotate-45')} />
                    <span className={cn('h-px w-6 bg-ivory transition-transform', menuOpen && '-translate-y-[3.5px] -rotate-45')} />
                </button>
            </div>

            {menuOpen && (
                <div className="fixed inset-0 top-20 z-40 flex flex-col justify-center gap-2 bg-forest-deep px-8 lg:hidden">
                    {NAV.map((item) => (
                        <AppLink
                            key={item.href}
                            href={item.href}
                            onClick={() => setMenuOpen(false)}
                            className="border-b border-ivory/10 py-4 font-serif text-3xl text-ivory"
                        >
                            {item.label}
                        </AppLink>
                    ))}
                    <LocaleSwitcher className="mt-6" />
                </div>
            )}
        </header>
    );
}
