import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

let registered = false;

export function ensureGsap() {
    if (!registered) {
        gsap.registerPlugin(ScrollTrigger);
        registered = true;
    }

    return { gsap, ScrollTrigger };
}

export function prefersReducedMotion(): boolean {
    return typeof window !== 'undefined' && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
}

export function isTouchDevice(): boolean {
    return typeof window !== 'undefined' && window.matchMedia('(pointer: coarse)').matches;
}
