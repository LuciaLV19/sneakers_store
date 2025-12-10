import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const toggleBtn = document.getElementById('theme-toggle');
const html = document.documentElement;

function updateButtonText() {
    if (html.classList.contains('dark')) {
        toggleBtn.textContent = 'Light Mode';
    } else {
        toggleBtn.textContent = 'Dark Mode';
    }
}

// Initialize button text on page load
updateButtonText();

// Update button text on toggle

toggleBtn.addEventListener('click', () => {
  html.classList.toggle('dark');
  updateButtonText();
});
