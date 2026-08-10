import { Link, usePage } from '@inertiajs/react';
import { useLocale, swapLocaleInPath } from '@/lib/locale';
import { locales, localeLabels } from '@/lib/translations';
import { cn } from '@/lib/utils';

type LocaleSwitcherProps = {
    className?: string;
};

export function LocaleSwitcher({ className }: LocaleSwitcherProps) {
    const locale = useLocale();
    const currentUrl = usePage().url;

    return (
        <div className={cn('flex items-center gap-1 text-xs font-medium tracking-[0.1em] uppercase', className)}>
            {locales.map((code, index) => (
                <span key={code} className="flex items-center gap-1">
                    {index > 0 && <span className="text-ivory/30">/</span>}
                    <Link
                        href={swapLocaleInPath(currentUrl, code)}
                        preserveScroll
                        className={cn('px-1 transition-colors', code === locale ? 'text-gold' : 'text-ivory/70 hover:text-ivory')}
                        aria-current={code === locale ? 'true' : undefined}
                    >
                        {localeLabels[code]}
                    </Link>
                </span>
            ))}
        </div>
    );
}
