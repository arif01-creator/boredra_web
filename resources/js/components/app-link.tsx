import { Link  } from '@inertiajs/react';
import type {InertiaLinkProps} from '@inertiajs/react';
import { useLocale, withLocale } from '@/lib/locale';

type AppLinkProps = Omit<InertiaLinkProps, 'href'> & { href: string };

/**
 * Drop-in replacement for Inertia's <Link> that automatically prefixes
 * internal paths with the active locale (e.g. "/about" -> "/en/about").
 */
export function AppLink({ href, ...props }: AppLinkProps) {
    const locale = useLocale();

    return <Link href={withLocale(locale, href)} {...props} />;
}
