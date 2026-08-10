import Alpine from 'alpinejs';
import 'trix';
import 'trix/dist/trix.css';

window.Alpine = Alpine;

document.addEventListener('alpine:init', () => {
    Alpine.data('confirmDialog', () => ({
        open: false,
        message: 'Are you sure?',
        formTarget: null,
        confirm(message, event) {
            this.message = message;
            this.formTarget = event.target.closest('form');
            this.open = true;
        },
        proceed() {
            this.formTarget?.submit();
            this.open = false;
        },
    }));

    Alpine.data('dropdown', () => ({
        open: false,
    }));

    Alpine.data('translatableField', (initial = {}) => ({
        active: 'en',
        values: { en: initial.en ?? '', bn: initial.bn ?? '' },
        translating: false,
        error: null,
        async translate() {
            const source = this.values.en?.trim();

            if (!source) {
                this.error = 'Enter the English text first.';

                return;
            }

            this.translating = true;
            this.error = null;

            try {
                const response = await fetch('/admin/translate', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        Accept: 'application/json',
                        'X-CSRF-TOKEN':
                            document.querySelector('meta[name="csrf-token"]')
                                ?.content ?? '',
                    },
                    body: JSON.stringify({
                        text: source,
                        target: 'bn',
                        format: 'text',
                    }),
                });

                const data = await response.json();

                if (!response.ok) {
                    this.error = data.message ?? 'Translation failed.';

                    return;
                }

                this.values.bn = data.translated;
                this.active = 'bn';
            } catch {
                this.error =
                    'Translation request failed. Check your connection and try again.';
            } finally {
                this.translating = false;
            }
        },
    }));

    Alpine.data('productLocalizedFields', (initial) => ({
        active: 'en',
        specs: initial.specs,
        rows: initial.rows.length ? initial.rows : [{ en: '', bn: '' }],
        translating: false,
        error: null,
        addRow() {
            this.rows.push({ en: '', bn: '' });
        },
        removeRow(index) {
            this.rows.splice(index, 1);
        },
        async translateOne(text) {
            const response = await fetch('/admin/translate', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    Accept: 'application/json',
                    'X-CSRF-TOKEN':
                        document.querySelector('meta[name="csrf-token"]')
                            ?.content ?? '',
                },
                body: JSON.stringify({ text, target: 'bn', format: 'text' }),
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message ?? 'Translation failed.');
            }

            return data.translated;
        },
        async translateAll() {
            this.translating = true;
            this.error = null;

            try {
                for (const key of Object.keys(this.specs.en)) {
                    const text = this.specs.en[key]?.trim();

                    if (text) {
                        this.specs.bn[key] = await this.translateOne(text);
                    }
                }

                for (const row of this.rows) {
                    const text = row.en?.trim();

                    if (text) {
                        row.bn = await this.translateOne(text);
                    }
                }

                this.active = 'bn';
            } catch (e) {
                this.error =
                    e instanceof Error ? e.message : 'Translation failed.';
            } finally {
                this.translating = false;
            }
        },
    }));

    Alpine.data('pageLocalizedForm', (initial) => ({
        active: 'en',
        values: initial,
        translating: false,
        error: null,
        async translateAll() {
            this.translating = true;
            this.error = null;

            try {
                for (const key of Object.keys(this.values.en)) {
                    const text = this.values.en[key]?.trim();

                    if (!text) {
                        continue;
                    }

                    const response = await fetch('/admin/translate', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            Accept: 'application/json',
                            'X-CSRF-TOKEN':
                                document.querySelector(
                                    'meta[name="csrf-token"]',
                                )?.content ?? '',
                        },
                        body: JSON.stringify({
                            text,
                            target: 'bn',
                            format: 'text',
                        }),
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data.message ?? 'Translation failed.');
                    }

                    this.values.bn[key] = data.translated;
                }

                this.active = 'bn';
            } catch (e) {
                this.error =
                    e instanceof Error ? e.message : 'Translation failed.';
            } finally {
                this.translating = false;
            }
        },
    }));

    Alpine.data('translatableRichText', () => ({
        active: 'en',
        translating: false,
        error: null,
        async translate() {
            const source = this.$refs.enEditor.editor
                .getDocument()
                .toString()
                .trim();

            if (!source) {
                this.error = 'Enter the English text first.';

                return;
            }

            this.translating = true;
            this.error = null;

            try {
                const response = await fetch('/admin/translate', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        Accept: 'application/json',
                        'X-CSRF-TOKEN':
                            document.querySelector('meta[name="csrf-token"]')
                                ?.content ?? '',
                    },
                    body: JSON.stringify({
                        text: this.$refs.enEditor.innerHTML,
                        target: 'bn',
                        format: 'html',
                    }),
                });

                const data = await response.json();

                if (!response.ok) {
                    this.error = data.message ?? 'Translation failed.';

                    return;
                }

                this.$refs.bnEditor.editor.loadHTML(data.translated);
                this.active = 'bn';
            } catch {
                this.error =
                    'Translation request failed. Check your connection and try again.';
            } finally {
                this.translating = false;
            }
        },
    }));
});

Alpine.start();
