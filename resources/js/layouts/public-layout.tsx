import { Head, usePage } from '@inertiajs/react';
import { useEffect, useState  } from 'react';
import type {ReactNode} from 'react';
import { BackToTop } from '@/components/back-to-top';
import { SiteFooter } from '@/components/site-footer';
import { SiteHeader } from '@/components/site-header';
import { cn } from '@/lib/utils';
import type { SeoProps } from '@/types/models';

type PublicLayoutProps = {
    children: ReactNode;
};

export default function PublicLayout({ children }: PublicLayoutProps) {
    const { seo } = usePage<{ seo?: SeoProps }>().props;
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const timer = setTimeout(() => setLoading(false), 700);

        return () => clearTimeout(timer);
    }, []);

    return (
        <div className="min-h-screen bg-white-warm">
            {seo && (
                <Head>
                    <title>{seo.title}</title>
                    <meta name="description" content={seo.description} />
                    <link rel="canonical" href={seo.canonical} />
                    <meta property="og:title" content={seo.ogTitle} />
                    <meta property="og:description" content={seo.ogDescription} />
                    {seo.ogImage && <meta property="og:image" content={seo.ogImage} />}
                </Head>
            )}

            <div
                aria-hidden={!loading}
                className={cn(
                    'fixed inset-0 z-[999] flex flex-col items-center justify-center gap-4 bg-forest-deep transition-opacity duration-500',
                    loading ? 'opacity-100' : 'pointer-events-none opacity-0',
                )}
            >
                <p className="text-center text-sm font-medium tracking-[0.3em] text-ivory uppercase">
                    Borendra
                    <br />
                    International
                </p>
                <span className="h-px w-24 overflow-hidden bg-ivory/15">
                    <span className="block h-full w-full origin-left animate-[loaderbar_0.7s_ease-in-out_forwards] bg-gold" />
                </span>
            </div>

            <SiteHeader />
            <main>{children}</main>
            <SiteFooter />
            <BackToTop />
        </div>
    );
}
