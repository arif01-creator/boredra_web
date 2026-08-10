import { Reveal } from '@/components/reveal';
import type { CompanyStat } from '@/types/models';

type StatsProps = {
    stats: CompanyStat[];
};

export function Stats({ stats }: StatsProps) {
    if (stats.length === 0) {
return null;
}

    return (
        <div className="grid grid-cols-1 gap-10 border-t border-stone pt-14 sm:grid-cols-3">
            {stats.map((stat, index) => (
                <Reveal key={stat.id} delay={index * 0.08}>
                    <p className="font-serif text-4xl text-forest-deep sm:text-5xl">{stat.value}</p>
                    <p className="label-micro mt-3 text-moss">{stat.label}</p>
                </Reveal>
            ))}
        </div>
    );
}
