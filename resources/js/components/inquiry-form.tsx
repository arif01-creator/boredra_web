import { useForm } from '@inertiajs/react';
import { CheckCircle2 } from 'lucide-react';
import type { FormEventHandler } from 'react';
import { MagneticButton } from '@/components/magnetic-button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';

type InquiryFormProps = {
    productOptions?: string[];
    tone?: 'light' | 'dark';
};

type InquiryFormData = {
    name: string;
    company: string;
    email: string;
    phone: string;
    country: string;
    product_interest: string;
    quantity: string;
    message: string;
    website: string;
};

export function InquiryForm({ productOptions = [], tone = 'light' }: InquiryFormProps) {
    const { data, setData, post, processing, errors, wasSuccessful, reset } = useForm<InquiryFormData>({
        name: '',
        company: '',
        email: '',
        phone: '',
        country: '',
        product_interest: '',
        quantity: '',
        message: '',
        website: '',
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        post('/contact', {
            preserveScroll: true,
            onSuccess: () => reset('name', 'company', 'email', 'phone', 'country', 'product_interest', 'quantity', 'message'),
        });
    };

    const isDark = tone === 'dark';
    const labelClass = isDark ? 'text-sage-soft' : 'text-moss';
    const inputClass = isDark
        ? 'border-ivory/20 bg-transparent text-ivory placeholder:text-ivory/40 focus-visible:border-gold'
        : 'border-stone bg-white focus-visible:border-forest';

    if (wasSuccessful) {
        return (
            <div className="flex items-start gap-3 rounded border border-gold/30 bg-gold/10 px-6 py-8">
                <CheckCircle2 className="mt-0.5 size-5 shrink-0 text-gold" />
                <div>
                    <p className={isDark ? 'text-ivory' : 'text-charcoal'}>Thank you — your inquiry has been received.</p>
                    <p className={`mt-1 text-sm ${labelClass}`}>Our team will respond as soon as possible.</p>
                </div>
            </div>
        );
    }

    return (
        <form onSubmit={submit} className="space-y-6">
            {/* Honeypot field — hidden from real users, bots tend to fill every field */}
            <input
                type="text"
                name="website"
                value={data.website}
                onChange={(e) => setData('website', e.target.value)}
                tabIndex={-1}
                autoComplete="off"
                className="hidden"
                aria-hidden="true"
            />

            <div className="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div className="space-y-2">
                    <Label htmlFor="name" className={labelClass}>
                        Name *
                    </Label>
                    <Input id="name" value={data.name} onChange={(e) => setData('name', e.target.value)} className={inputClass} required />
                    {errors.name && <p className="text-xs text-red-400">{errors.name}</p>}
                </div>

                <div className="space-y-2">
                    <Label htmlFor="company" className={labelClass}>
                        Company
                    </Label>
                    <Input id="company" value={data.company} onChange={(e) => setData('company', e.target.value)} className={inputClass} />
                </div>

                <div className="space-y-2">
                    <Label htmlFor="email" className={labelClass}>
                        Email *
                    </Label>
                    <Input id="email" type="email" value={data.email} onChange={(e) => setData('email', e.target.value)} className={inputClass} required />
                    {errors.email && <p className="text-xs text-red-400">{errors.email}</p>}
                </div>

                <div className="space-y-2">
                    <Label htmlFor="phone" className={labelClass}>
                        Phone
                    </Label>
                    <Input id="phone" value={data.phone} onChange={(e) => setData('phone', e.target.value)} className={inputClass} />
                </div>

                <div className="space-y-2">
                    <Label htmlFor="country" className={labelClass}>
                        Country
                    </Label>
                    <Input id="country" value={data.country} onChange={(e) => setData('country', e.target.value)} className={inputClass} />
                </div>

                <div className="space-y-2">
                    <Label htmlFor="product_interest" className={labelClass}>
                        Product Interest
                    </Label>
                    <Select value={data.product_interest} onValueChange={(value) => setData('product_interest', value)}>
                        <SelectTrigger id="product_interest" className={inputClass}>
                            <SelectValue placeholder="Select a material" />
                        </SelectTrigger>
                        <SelectContent>
                            {productOptions.map((option) => (
                                <SelectItem key={option} value={option}>
                                    {option}
                                </SelectItem>
                            ))}
                        </SelectContent>
                    </Select>
                </div>
            </div>

            <div className="space-y-2">
                <Label htmlFor="quantity" className={labelClass}>
                    Quantity / Requirement
                </Label>
                <Input id="quantity" value={data.quantity} onChange={(e) => setData('quantity', e.target.value)} className={inputClass} />
            </div>

            <div className="space-y-2">
                <Label htmlFor="message" className={labelClass}>
                    Message *
                </Label>
                <textarea
                    id="message"
                    value={data.message}
                    onChange={(e) => setData('message', e.target.value)}
                    required
                    rows={5}
                    className={`w-full rounded border px-3 py-2.5 text-sm outline-none ${inputClass}`}
                />
                {errors.message && <p className="text-xs text-red-400">{errors.message}</p>}
            </div>

            <MagneticButton type="submit" disabled={processing} variant={isDark ? 'solid' : 'dark'}>
                {processing ? 'Sending…' : 'Send Inquiry →'}
            </MagneticButton>
        </form>
    );
}
