import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

document.addEventListener('alpine:init', () => {
    console.log('Alpine.js Initialized');
});

Alpine.start();

// Handle mobile sidebar
window.addEventListener('resize', () => {
    if (window.innerWidth >= 1024) {
        document.querySelector('.sidebar').classList.remove('open');
    }
});

window.addEventListener('DOMContentLoaded', (event) => {
    console.log('DOM fully loaded and parsed');
});
