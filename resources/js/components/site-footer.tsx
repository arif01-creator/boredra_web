import { usePage } from '@inertiajs/react';
import { AppLink } from '@/components/app-link';
import { useTranslations } from '@/lib/locale';
import type { SiteSettings } from '@/types/models';

export function SiteFooter() {
    const t = useTranslations();
    const { settings } = usePage<{ settings: SiteSettings }>().props;
    const year = new Date().getFullYear();

    const NAV = [
        { label: t('nav.home'), href: '/' },
        { label: t('nav.about'), href: '/about' },
        { label: t('nav.products'), href: '/products' },
        { label: t('nav.quality'), href: '/quality' },
        { label: t('nav.globalReach'), href: '/global-reach' },
        { label: t('nav.companyProfile'), href: '/company-profile' },
        { label: t('nav.contact'), href: '/contact' },
    ];

    const socials = [
        { label: 'Facebook', href: settings?.social_facebook },
        { label: 'LinkedIn', href: settings?.social_linkedin },
        { label: 'Instagram', href: settings?.social_instagram },
    ].filter((s) => s.href);

    return (
        <footer className="bg-forest-deep text-ivory">
            <div className="container-editorial grid grid-cols-1 gap-12 py-20 sm:grid-cols-2 lg:grid-cols-4 lg:py-24">
                <div>
                    <p className="text-sm font-medium tracking-[0.25em] uppercase">Borendra</p>
                    <p className="text-[10px] tracking-[0.3em] text-sage-soft uppercase">International</p>
                    <p className="mt-5 max-w-xs text-sm leading-relaxed text-sage-soft">{t('footer.description')}</p>
                </div>

                <div>
                    <p className="label-micro mb-5 text-sage-soft">{t('footer.navigate')}</p>
                    <ul className="space-y-2.5 text-sm">
                        {NAV.map((item) => (
                            <li key={item.href}>
                                <AppLink href={item.href} className="text-ivory/85 transition-colors hover:text-gold">
                                    {item.label}
                                </AppLink>
                            </li>
                        ))}
                    </ul>
                </div>

                <div>
                    <p className="label-micro mb-5 text-sage-soft">{t('footer.contact')}</p>
                    <ul className="space-y-2.5 text-sm text-ivory/85">
                        <li>{settings?.company_address ?? t('common.dhakaBangladesh')}</li>
                        {settings?.company_phone && <li>{settings.company_phone}</li>}
                        {settings?.company_email && (
                            <li>
                                <a href={`mailto:${settings.company_email}`} className="hover:text-gold">
                                    {settings.company_email}
                                </a>
                            </li>
                        )}
                    </ul>
                </div>

                <div>
                    <p className="label-micro mb-5 text-sage-soft">{t('footer.legal')}</p>
                    <ul className="space-y-2.5 text-sm">
                        <li>
                            <AppLink href="/privacy" className="text-ivory/85 hover:text-gold">
                                {t('footer.privacy')}
                            </AppLink>
                        </li>
                        <li>
                            <AppLink href="/terms" className="text-ivory/85 hover:text-gold">
                                {t('footer.terms')}
                            </AppLink>
                        </li>
                    </ul>

                    {socials.length > 0 && (
                        <div className="mt-6 flex gap-4">
                            {socials.map((s) => (
                                <a key={s.label} href={s.href!} target="_blank" rel="noreferrer" className="text-xs text-sage-soft hover:text-gold">
                                    {s.label}
                                </a>
                            ))}
                        </div>
                    )}
                </div>
            </div>

            <div className="border-t border-ivory/10">
                <div className="container-editorial flex flex-col items-center justify-between gap-2 py-6 text-xs text-sage-soft sm:flex-row">
                    <p>
                        © {year} Borendra International. {t('footer.rights')}
                    </p>
                    <p>{t('common.dhakaBangladesh')}</p>
                </div>
            </div>
        </footer>
    );
}
