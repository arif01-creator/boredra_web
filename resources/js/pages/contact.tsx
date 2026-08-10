import { InquiryForm } from '@/components/inquiry-form';
import { Section } from '@/components/section';

type ContactProps = {
    productOptions: string[];
};

export default function Contact({ productOptions }: ContactProps) {
    return (
        <Section tone="forest" className="pt-44">
            <div className="grid grid-cols-1 gap-16 lg:grid-cols-2 lg:gap-24">
                <div>
                    <p className="label-micro text-gold">Get In Touch</p>
                    <h1 className="mt-6 max-w-lg text-[clamp(2.5rem,5.5vw,4.5rem)] leading-[1.03] font-serif text-ivory">
                        Let&apos;s build
                        <br />a global connection.
                    </h1>
                    <p className="mt-6 max-w-md text-sage-soft">
                        Share your requirements and our team will respond with the information you need.
                    </p>
                </div>

                <InquiryForm productOptions={productOptions} tone="dark" />
            </div>
        </Section>
    );
}
