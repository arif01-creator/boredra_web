import { useEffect, useRef } from 'react';
import { ensureGsap, prefersReducedMotion } from '@/lib/gsap';
import type { GlobalMarket } from '@/types/models';

type GlobalMapProps = {
    markets: GlobalMarket[];
};

const WIDTH = 1000;
const HEIGHT = 480;
const ORIGIN = { lat: 23.8103, lng: 90.4125 }; // Dhaka, Bangladesh

function project(lat: number, lng: number) {
    const x = ((lng + 180) / 360) * WIDTH;
    const y = ((90 - lat) / 180) * HEIGHT;
    return { x, y };
}

function arcPath(from: { x: number; y: number }, to: { x: number; y: number }) {
    const mx = (from.x + to.x) / 2;
    const my = Math.min(from.y, to.y) - Math.abs(to.x - from.x) * 0.18 - 24;
    return `M ${from.x} ${from.y} Q ${mx} ${my} ${to.x} ${to.y}`;
}

export function GlobalMap({ markets }: GlobalMapProps) {
    const svgRef = useRef<SVGSVGElement>(null);
    const origin = project(ORIGIN.lat, ORIGIN.lng);
    const reduced = prefersReducedMotion();

    useEffect(() => {
        const svg = svgRef.current;
        if (!svg || reduced) return;

        const { gsap, ScrollTrigger } = ensureGsap();
        const paths = svg.querySelectorAll<SVGPathElement>('.route-path');
        const dots = svg.querySelectorAll<SVGCircleElement>('.route-dot');

        const ctx = gsap.context(() => {
            paths.forEach((path) => {
                const length = path.getTotalLength();
                gsap.set(path, { strokeDasharray: length, strokeDashoffset: length });
                gsap.to(path, {
                    strokeDashoffset: 0,
                    duration: 1.6,
                    ease: 'power2.out',
                    scrollTrigger: { trigger: svg, start: 'top 70%', once: true },
                });
            });

            gsap.fromTo(
                dots,
                { scale: 0, transformOrigin: 'center' },
                {
                    scale: 1,
                    duration: 0.5,
                    stagger: 0.12,
                    delay: 1,
                    ease: 'back.out(2)',
                    scrollTrigger: { trigger: svg, start: 'top 70%', once: true },
                },
            );
        }, svg);

        return () => {
            ctx.revert();
            ScrollTrigger.getAll().forEach((t) => {
                if (t.trigger === svg) t.kill();
            });
        };
    }, [reduced, markets.length]);

    const gridLines = [];
    for (let i = 0; i <= 12; i++) gridLines.push((i * WIDTH) / 12);
    const gridRows = [];
    for (let i = 0; i <= 6; i++) gridRows.push((i * HEIGHT) / 6);

    return (
        <svg ref={svgRef} viewBox={`0 0 ${WIDTH} ${HEIGHT}`} className="h-auto w-full" role="img" aria-label="Map of export destinations from Bangladesh">
            {gridLines.map((x) => (
                <line key={`v-${x}`} x1={x} y1={0} x2={x} y2={HEIGHT} stroke="currentColor" className="text-sage/15" strokeWidth={1} />
            ))}
            {gridRows.map((y) => (
                <line key={`h-${y}`} x1={0} y1={y} x2={WIDTH} y2={y} stroke="currentColor" className="text-sage/15" strokeWidth={1} />
            ))}

            {markets.map((market) => {
                const point = project(market.latitude, market.longitude);
                return (
                    <g key={market.id}>
                        <path
                            d={arcPath(origin, point)}
                            fill="none"
                            stroke="currentColor"
                            className={reduced ? 'text-gold' : 'route-path text-gold'}
                            strokeWidth={1.25}
                        />
                        <circle cx={point.x} cy={point.y} r={4} className="route-dot fill-gold" />
                        <text x={point.x + 8} y={point.y - 8} className="fill-forest text-[11px] tracking-wide" style={{ fontFamily: 'var(--font-sans)' }}>
                            {market.country}
                        </text>
                    </g>
                );
            })}

            <circle cx={origin.x} cy={origin.y} r={6} className="fill-forest-deep" />
            <circle cx={origin.x} cy={origin.y} r={10} className="fill-none stroke-forest-deep" strokeWidth={1} opacity={0.4} />
            <text x={origin.x + 12} y={origin.y + 4} className="fill-forest-deep text-xs font-medium tracking-wide">
                Bangladesh
            </text>
        </svg>
    );
}
