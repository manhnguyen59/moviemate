// ─── MovieMate App JS ───────────────────────────────────────────────────────

/**
 * Theme management: dark / light
 * Reads from localStorage, applies 'light' class to <html>,
 * and syncs all toggle buttons on the page.
 */

const THEME_KEY = 'moviemate_theme';

function applyTheme(theme) {
    const html = document.documentElement;
    if (theme === 'light') {
        html.classList.add('light');
    } else {
        html.classList.remove('light');
    }
    // Update all theme toggle buttons on the page
    const icons = document.querySelectorAll('.theme-icon');
    const texts = document.querySelectorAll('.theme-text');
    icons.forEach(el => { el.textContent = theme === 'light' ? '☀️' : '🌙'; });
    texts.forEach(el => { el.textContent = theme === 'light' ? 'Sáng' : 'Tối'; });
}

function toggleTheme() {
    const current = localStorage.getItem(THEME_KEY) || 'dark';
    const next = current === 'dark' ? 'light' : 'dark';
    localStorage.setItem(THEME_KEY, next);
    applyTheme(next);
}

// Apply saved theme on page load
(function initTheme() {
    const saved = localStorage.getItem(THEME_KEY) || 'dark';
    applyTheme(saved);
})();

// Bind click events after DOM is ready
document.addEventListener('DOMContentLoaded', function () {
    // Bind ALL theme toggle buttons (multiple layouts may exist)
    document.querySelectorAll('[data-theme-toggle]').forEach(btn => {
        btn.addEventListener('click', toggleTheme);
    });
});
