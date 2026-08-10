import { usePage } from '@inertiajs/react';
import { dictionaries, locales   } from '@/lib/translations';
import type {Locale, TranslationKey} from '@/lib/translations';

export function useLocale(): Locale {
    const { locale } = usePage<{ locale: string }>().props;

    return locales.includes(locale as Locale) ? (locale as Locale) : 'en';
}

export function useTranslations(): (key: TranslationKey) => string {
    const locale = useLocale();

    return (key: TranslationKey) => dictionaries[locale][key] ?? dictionaries.en[key];
}

/**
 * Prefixes an internal path with the given locale. External URLs, hash
 * anchors, and mailto/tel links are passed through untouched.
 */
export function withLocale(locale: string, href: string): string {
    if (/^([a-z][a-z0-9+.-]*:)?\/\//i.test(href) || href.startsWith('#') || href.startsWith('mailto:') || href.startsWith('tel:')) {
        return href;
    }

    const path = href === '/' ? '' : href;

    return `/${locale}${path}`;
}

/**
 * Swaps the locale segment of a given app-relative path (e.g. "/en/about")
 * for another locale, preserving the rest of the path. Falls back to the
 * bare locale root if the path doesn't look locale-prefixed.
 */
export function swapLocaleInPath(path: string, nextLocale: Locale): string {
    const segments = path.split('/').filter(Boolean);

    if (locales.includes(segments[0] as Locale)) {
        segments[0] = nextLocale;
    } else {
        segments.unshift(nextLocale);
    }

    return `/${segments.join('/')}`;
}
