/**
 * Theme management: dark / light.
 * Reads from localStorage, applies the `light` class to <html>,
 * and syncs every theme toggle rendered by User, Staff, and Admin layouts.
 */

const THEME_KEY = 'moviemate_theme';

function getStoredTheme() {
    try {
        return localStorage.getItem(THEME_KEY) || 'dark';
    } catch (error) {
        return 'dark';
    }
}

function setStoredTheme(theme) {
    try {
        localStorage.setItem(THEME_KEY, theme);
    } catch (error) {
        // Storage can be blocked in private contexts; keep the page usable.
    }
}

function applyTheme(theme) {
    const html = document.documentElement;

    if (theme === 'light') {
        html.classList.add('light');
    } else {
        html.classList.remove('light');
    }

    document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
        button.setAttribute('aria-pressed', theme === 'light' ? 'true' : 'false');
        button.setAttribute('title', theme === 'light' ? 'Đổi sang giao diện tối' : 'Đổi sang giao diện sáng');
    });

    document.querySelectorAll('.theme-icon').forEach((element) => {
        element.innerHTML = theme === 'light'
            ? '<i class="ph-fill ph-sun"></i>'
            : '<i class="ph-fill ph-moon"></i>';
    });

    document.querySelectorAll('.theme-text').forEach((element) => {
        element.textContent = theme === 'light' ? 'Sáng' : 'Tối';
    });
}

function toggleTheme() {
    const current = getStoredTheme();
    const next = current === 'dark' ? 'light' : 'dark';
    setStoredTheme(next);
    applyTheme(next);
}

applyTheme(getStoredTheme());

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
        button.addEventListener('click', toggleTheme);
    });
});

const posterFallbackSvg = encodeURIComponent(`
<svg xmlns="http://www.w3.org/2000/svg" width="500" height="750" viewBox="0 0 500 750">
  <defs>
    <linearGradient id="g" x1="0" y1="0" x2="1" y2="1">
      <stop offset="0" stop-color="#151A27"/>
      <stop offset="0.55" stop-color="#2D3343"/>
      <stop offset="1" stop-color="#080A12"/>
    </linearGradient>
  </defs>
  <rect width="500" height="750" fill="url(#g)"/>
  <circle cx="250" cy="300" r="78" fill="#FF3D57" opacity="0.18"/>
  <path d="M206 260h88a18 18 0 0 1 18 18v78a18 18 0 0 1-18 18h-88a18 18 0 0 1-18-18v-78a18 18 0 0 1 18-18zm16 30v54l54-27-54-27z" fill="#ffffff" opacity="0.82"/>
  <text x="250" y="455" text-anchor="middle" fill="#ffffff" font-family="Arial, sans-serif" font-size="34" font-weight="700">MovieMate</text>
  <text x="250" y="496" text-anchor="middle" fill="#9CA3AF" font-family="Arial, sans-serif" font-size="22">Poster unavailable</text>
</svg>`);

const posterFallbackSrc = `data:image/svg+xml;charset=UTF-8,${posterFallbackSvg}`;

document.addEventListener('error', (event) => {
    const image = event.target;

    if (!(image instanceof HTMLImageElement) || image.dataset.fallbackApplied === 'true') {
        return;
    }

    image.dataset.fallbackApplied = 'true';
    image.src = posterFallbackSrc;
}, true);
