import * as bootstrap from 'bootstrap';

window.bootstrap = bootstrap;

const switcher = document.getElementById('themeSwitch');
const cartIcon = document.getElementById('cartIcon');
const themeIcon = document.getElementById('themeIcon');

if (switcher) {
    const savedTheme = localStorage.getItem('theme');

    const theme = savedTheme
        ? savedTheme
        : (window.matchMedia('(prefers-color-scheme: dark)').matches
            ? 'dark'
            : 'light');

    document.documentElement.setAttribute('data-bs-theme', theme);
    switcher.checked = theme === 'dark';

    updateTheme(theme);

    switcher.addEventListener('change', function () {
        const newTheme = this.checked ? 'dark' : 'light';

        document.documentElement.setAttribute('data-bs-theme', newTheme);
        localStorage.setItem('theme', newTheme);

        updateTheme(newTheme);
    });
}

function updateTheme(theme) {
    updateThemeIcon(theme);
    updateCartIcon(theme);
}

function updateThemeIcon(theme) {
    if (!themeIcon) return;

    if (theme === 'dark') {
        themeIcon.className = 'bi bi-moon-stars-fill fs-5';
    } else {
        themeIcon.className = 'bi bi-sun-fill fs-5';
    }
}

function updateCartIcon(theme) {
    if (!cartIcon) return;

    cartIcon.classList.remove('text-white', 'text-dark', 'text-secondary');

    if (theme === 'dark') {
        cartIcon.classList.add('text-white');
    } else {
        cartIcon.classList.add('text-dark');
    }
}
