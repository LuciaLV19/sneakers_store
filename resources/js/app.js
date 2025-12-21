import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const toggleBtn = document.getElementById('theme-toggle');
const html = document.documentElement;
const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#password');
const eyeIcon = document.querySelector('#eyeIcon');

function updateButtonText() {
    if (html.classList.contains('dark')) {
        if (toggleBtn) {
            toggleBtn.textContent = 'Light Mode';
        }
    } else {
        if (toggleBtn) {
            toggleBtn.textContent = 'Dark Mode';
        }
    }
}

// Initialize button text on page load
updateButtonText();

// Update button text on toggle

toggleBtn.addEventListener('click', () => {
  html.classList.toggle('dark');
  updateButtonText();
});

togglePassword.addEventListener('click', function (e) {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        eyeIcon.classList.toggle('fa-eye');
        eyeIcon.classList.toggle('fa-eye-slash');
    });