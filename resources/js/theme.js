/**
 * Theme (dark/light mode) management for Pemetaan Coffee.
 * Reads and persists the user's preference in localStorage.
 */

/**
 * Apply the saved theme from localStorage on page load.
 * Called immediately so there is no flash of unstyled content.
 */
export function applyStoredTheme() {
    if (localStorage.getItem('theme') === 'dark') {
        document.documentElement.setAttribute('data-theme', 'dark');
    } else {
        document.documentElement.removeAttribute('data-theme');
    }
}

/**
 * Wire up the #btn-theme toggle button (if present on the page).
 * Updates the icon, the data-theme attribute, and localStorage.
 */
export function initThemeToggle() {
    const btn = document.getElementById('btn-theme');
    if (!btn) return;

    // Sync icon with current theme on load
    const syncIcon = () => {
        const icon = btn.querySelector('i');
        if (!icon) return;
        const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
        if (isDark) {
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
        } else {
            icon.classList.remove('fa-sun');
            icon.classList.add('fa-moon');
        }
    };

    syncIcon();

    btn.addEventListener('click', () => {
        const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
        if (isDark) {
            document.documentElement.removeAttribute('data-theme');
            localStorage.setItem('theme', 'light');
        } else {
            document.documentElement.setAttribute('data-theme', 'dark');
            localStorage.setItem('theme', 'dark');
        }
        syncIcon();
    });
}

// Apply stored theme immediately (before DOM is fully parsed) to avoid FOUC
applyStoredTheme();
