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
});

Alpine.start();
