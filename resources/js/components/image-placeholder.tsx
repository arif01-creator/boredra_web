import { cn } from '@/lib/utils';

type ImagePlaceholderProps = {
    src?: string | null;
    alt: string;
    className?: string;
    label?: string;
};

/**
 * Renders the given image when available; otherwise falls back to a
 * tasteful Forest-toned gradient placeholder so layouts stay intact
 * before real photography is uploaded via Admin → Media.
 */
export function ImagePlaceholder({ src, alt, className, label }: ImagePlaceholderProps) {
    if (src) {
        return <img src={src} alt={alt} className={cn('h-full w-full object-cover', className)} loading="lazy" />;
    }

    return (
        <div
            className={cn(
                'relative flex h-full w-full items-end justify-start overflow-hidden bg-gradient-to-br from-forest-deep via-pine to-forest',
                className,
            )}
        >
            <div
                className="absolute inset-0 opacity-[0.06]"
                style={{
                    backgroundImage:
                        'radial-gradient(circle at 20% 20%, white 0, transparent 45%), radial-gradient(circle at 80% 60%, white 0, transparent 40%)',
                }}
            />
            <span className="label-micro relative px-4 py-3 text-sage-soft/40">{label ?? alt}</span>
        </div>
    );
}
