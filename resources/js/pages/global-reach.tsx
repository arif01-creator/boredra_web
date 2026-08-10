import { Cta } from '@/components/cta';
import { GlobalMap } from '@/components/global-map';
import { Reveal } from '@/components/reveal';
import { Section } from '@/components/section';
import type { GlobalMarket } from '@/types/models';

type GlobalReachProps = {
    markets: GlobalMarket[];
};

export default function GlobalReach({ markets }: GlobalReachProps) {
    return (
        <>
            <Section tone="forest" className="pt-44 pb-16">
                <p className="label-micro text-gold">Global Reach</p>
                <h1 className="mt-6 max-w-3xl text-[clamp(2.5rem,6vw,5rem)] leading-[1.02] font-serif text-ivory">
                    From Bangladesh
                    <br />
                    to Global Markets.
                </h1>
            </Section>

            <Section tone="white">
                <Reveal>
                    <GlobalMap markets={markets} />
                </Reveal>

                {markets.length === 0 ? (
                    <p className="mt-8 text-sm text-moss">Export destinations will appear here as they are confirmed and added via Admin.</p>
                ) : (
                    <div className="mt-16 grid grid-cols-1 gap-8 border-t border-stone pt-10 sm:grid-cols-2 lg:grid-cols-3">
                        {markets.map((market) => (
                            <Reveal key={market.id}>
                                <p className="font-serif text-lg text-charcoal">{market.country}</p>
                                {market.description && <p className="mt-2 text-sm text-moss">{market.description}</p>}
                            </Reveal>
                        ))}
                    </div>
                )}
            </Section>

            <Cta
                heading={'Looking to\nsource from Bangladesh?'}
                actionLabel="Send Inquiry"
                actionHref="/contact"
            />
        </>
    );
}
