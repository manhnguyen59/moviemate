/**
 * Theme management: dark / light.
 * Reads from localStorage, applies the `light` class to <html>,
 * and syncs every theme toggle rendered by User, Staff, and Admin layouts.
 */

const THEME_KEY = 'theme';
const LEGACY_THEME_KEY = 'moviemate_theme';
const SHOWTIME_QUERY_KEYS = ['cinema_id', 'date', 'city', 'brand', 'nearby', 'lat', 'lng'];

function getStoredTheme() {
    try {
        return localStorage.getItem(THEME_KEY) || localStorage.getItem(LEGACY_THEME_KEY) || 'dark';
    } catch (error) {
        return 'dark';
    }
}

function setStoredTheme(theme) {
    try {
        localStorage.setItem(THEME_KEY, theme);
        localStorage.setItem(LEGACY_THEME_KEY, theme);
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

    setStoredTheme(theme);

    document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
        button.setAttribute('aria-pressed', theme === 'light' ? 'true' : 'false');
        button.setAttribute('title', theme === 'light' ? '\u0110\u1ed5i sang giao di\u1ec7n t\u1ed1i' : '\u0110\u1ed5i sang giao di\u1ec7n s\u00e1ng');
    });

    document.querySelectorAll('[data-theme-icon]').forEach((icon) => {
        icon.textContent = theme === 'light' ? '\u2600\ufe0f' : '\ud83c\udf19';
    });

    document.querySelectorAll('[data-theme-text]').forEach((text) => {
        text.textContent = theme === 'light' ? 'S\u00e1ng' : 'T\u1ed1i';
    });

    document.querySelectorAll('.theme-icon').forEach((element) => {
        element.innerHTML = theme === 'light'
            ? '<i class="ph-fill ph-sun"></i>'
            : '<i class="ph-fill ph-moon"></i>';
    });

    document.querySelectorAll('.theme-text').forEach((element) => {
        element.textContent = theme === 'light' ? 'S\u00e1ng' : 'T\u1ed1i';
    });
}

function toggleTheme() {
    const current = document.documentElement.classList.contains('light') ? 'light' : 'dark';
    const next = current === 'light' ? 'dark' : 'light';
    applyTheme(next);
}

applyTheme(getStoredTheme());

document.addEventListener('click', (event) => {
    const button = event.target.closest('[data-theme-toggle]');

    if (!button) {
        return;
    }

    toggleTheme();
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
  <text x="250" y="496" text-anchor="middle" fill="#9CA3AF" font-family="Arial, sans-serif" font-size="22">Poster MovieMate</text>
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

function shouldPinShowtimeSection() {
    const params = new URLSearchParams(window.location.search);

    return window.location.hash === '#home-showtime-calendar'
        || SHOWTIME_QUERY_KEYS.some((key) => params.has(key));
}

function scrollToShowtimeSection() {
    const section = document.getElementById('home-showtime-calendar');

    if (!section) {
        return;
    }

    const headerOffset = 100;
    const top = section.getBoundingClientRect().top + window.pageYOffset - headerOffset;

    window.scrollTo({
        top: Math.max(top, 0),
        behavior: 'auto',
    });
}

function setShowtimeLoading(section, isLoading) {
    section.classList.toggle('showtime-section-loading', isLoading);
    section.setAttribute('aria-busy', isLoading ? 'true' : 'false');
}

function setNearbyButtonLoading(button, isLoading) {
    const label = button.querySelector('[data-nearby-label]');

    button.disabled = isLoading;
    button.classList.toggle('opacity-70', isLoading);
    button.classList.toggle('cursor-wait', isLoading);

    if (label) {
        label.textContent = isLoading ? '\u0110ang l\u1ea5y v\u1ecb tr\u00ed...' : 'G\u1ea7n b\u1ea1n';
    }
}

function redirectToNearby(latitude, longitude) {
    const url = new URL(window.location.href);

    url.searchParams.set('nearby', '1');
    url.searchParams.set('lat', String(latitude));
    url.searchParams.set('lng', String(longitude));
    url.hash = 'home-showtime-calendar';

    window.location.href = url.toString();
}

function handleNearbyError(error) {
    if (error.code === error.PERMISSION_DENIED) {
        alert('B\u1ea1n c\u1ea7n cho ph\u00e9p truy c\u1eadp v\u1ecb tr\u00ed \u0111\u1ec3 t\u00ecm r\u1ea1p g\u1ea7n b\u1ea1n.');
        return;
    }

    if (error.code === error.POSITION_UNAVAILABLE) {
        alert('Kh\u00f4ng th\u1ec3 x\u00e1c \u0111\u1ecbnh v\u1ecb tr\u00ed hi\u1ec7n t\u1ea1i.');
        return;
    }

    if (error.code === error.TIMEOUT) {
        alert('L\u1ea5y v\u1ecb tr\u00ed qu\u00e1 l\u00e2u, vui l\u00f2ng th\u1eed l\u1ea1i.');
        return;
    }

    alert('Kh\u00f4ng th\u1ec3 l\u1ea5y v\u1ecb tr\u00ed hi\u1ec7n t\u1ea1i, vui l\u00f2ng th\u1eed l\u1ea1i.');
}

function requestNearbyLocation(button) {
    if (!navigator.geolocation) {
        alert('Tr\u00ecnh duy\u1ec7t c\u1ee7a b\u1ea1n kh\u00f4ng h\u1ed7 tr\u1ee3 \u0111\u1ecbnh v\u1ecb.');
        return;
    }

    setNearbyButtonLoading(button, true);

    navigator.geolocation.getCurrentPosition(
        (position) => {
            redirectToNearby(position.coords.latitude, position.coords.longitude);
        },
        (error) => {
            setNearbyButtonLoading(button, false);
            handleNearbyError(error);
        },
        {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 60000,
        },
    );
}

async function updateShowtimeSection(targetUrl) {
    const section = document.getElementById('home-showtime-calendar');

    if (!section) {
        window.location.href = targetUrl.href;
        return;
    }

    const ajaxUrl = new URL(section.dataset.showtimeAjaxUrl || '/ajax/showtimes', window.location.origin);
    ajaxUrl.search = targetUrl.search;

    setShowtimeLoading(section, true);

    try {
        const response = await fetch(ajaxUrl.toString(), {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html',
            },
        });

        if (!response.ok) {
            throw new Error(`Showtime request failed: ${response.status}`);
        }

        const html = await response.text();
        section.outerHTML = html;
        history.pushState({}, '', targetUrl.toString());

        const nextSection = document.getElementById('home-showtime-calendar');
        if (nextSection) {
            nextSection.setAttribute('aria-busy', 'false');
        }
    } catch (error) {
        window.location.href = targetUrl.href;
    }
}

if (shouldPinShowtimeSection()) {
    document.documentElement.style.scrollBehavior = 'auto';
}

document.addEventListener('DOMContentLoaded', () => {
    if (shouldPinShowtimeSection()) {
        requestAnimationFrame(scrollToShowtimeSection);
    }
});

window.addEventListener('load', () => {
    if (shouldPinShowtimeSection()) {
        scrollToShowtimeSection();
    }
});

window.addEventListener('popstate', () => {
    if (shouldPinShowtimeSection()) {
        window.location.reload();
    }
});

document.addEventListener('click', (event) => {
    const nearbyButton = event.target.closest('#nearbyCinemaBtn');

    if (nearbyButton) {
        event.preventDefault();
        requestNearbyLocation(nearbyButton);
        return;
    }

    const link = event.target.closest('a[data-showtime-filter]');

    if (!link || event.defaultPrevented || event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
        return;
    }

    event.preventDefault();

    const targetUrl = new URL(link.href, window.location.origin);

    if (targetUrl.hash !== '#home-showtime-calendar') {
        targetUrl.hash = 'home-showtime-calendar';
    }

    updateShowtimeSection(targetUrl);
});
