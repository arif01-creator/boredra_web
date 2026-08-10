import { Link, usePage } from '@inertiajs/react';
import type { SiteSettings } from '@/types/models';

const NAV = [
    { label: 'Home', href: '/' },
    { label: 'About', href: '/about' },
    { label: 'Products', href: '/products' },
    { label: 'Quality', href: '/quality' },
    { label: 'Global Reach', href: '/global-reach' },
    { label: 'Company Profile', href: '/company-profile' },
    { label: 'Contact', href: '/contact' },
];

export function SiteFooter() {
    const { settings } = usePage<{ settings: SiteSettings }>().props;
    const year = new Date().getFullYear();

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
                    <p className="mt-5 max-w-xs text-sm leading-relaxed text-sage-soft">
                        A registered exporting company based in Dakshinkhan, Dhaka, Bangladesh, supplying human hair, dressed hair,
                        animal hair and synthetic materials to the global wig and hair-product industry.
                    </p>
                </div>

                <div>
                    <p className="label-micro mb-5 text-sage-soft">Navigate</p>
                    <ul className="space-y-2.5 text-sm">
                        {NAV.map((item) => (
                            <li key={item.href}>
                                <Link href={item.href} className="text-ivory/85 transition-colors hover:text-gold">
                                    {item.label}
                                </Link>
                            </li>
                        ))}
                    </ul>
                </div>

                <div>
                    <p className="label-micro mb-5 text-sage-soft">Contact</p>
                    <ul className="space-y-2.5 text-sm text-ivory/85">
                        <li>{settings?.company_address ?? 'Dakshinkhan, Dhaka, Bangladesh'}</li>
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
                    <p className="label-micro mb-5 text-sage-soft">Legal</p>
                    <ul className="space-y-2.5 text-sm">
                        <li>
                            <Link href="/privacy" className="text-ivory/85 hover:text-gold">
                                Privacy Policy
                            </Link>
                        </li>
                        <li>
                            <Link href="/terms" className="text-ivory/85 hover:text-gold">
                                Terms
                            </Link>
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
                    <p>© {year} Borendra International. All Rights Reserved.</p>
                    <p>Dakshinkhan, Dhaka, Bangladesh</p>
                </div>
            </div>
        </footer>
    );
}
