import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

document.addEventListener('alpine:init', () => {
    Alpine.data('themeManager', () => ({
        isDark: true,
        init() {
            const saved = localStorage.getItem('theme');
            if (saved) {
                this.isDark = saved === 'dark';
            } else {
                this.isDark = !window.matchMedia('(prefers-color-scheme: light)').matches;
            }
            this.applyTheme();
        },
        toggle() {
            this.isDark = !this.isDark;
            localStorage.setItem('theme', this.isDark ? 'dark' : 'light');
            this.applyTheme();
        },
        applyTheme() {
            document.documentElement.classList.toggle('dark', this.isDark);
            document.documentElement.classList.toggle('light', !this.isDark);
        }
    }));

    Alpine.data('loadingScreen', () => ({
        show: false,
        init() {
            document.addEventListener('click', (e) => {
                const link = e.target.closest('a');
                if (!link) return;
                if (link.target === '_blank') return;
                if (link.hostname !== window.location.hostname) return;
                if (link.getAttribute('href') === '#') return;
                if (link.dataset.noLoader) return;

                const isNavLink = link.closest('nav') || link.closest('[data-nav]');
                const isProductLink = link.href.includes('/produk');

                if (isNavLink || isProductLink) {
                    e.preventDefault();
                    this.show = true;
                    setTimeout(() => {
                        window.location.href = link.href;
                    }, 1500);
                }
            });
        }
    }));

    Alpine.data('welcomeAnimation', () => ({
        show: true,
        init() {
            const hasSeen = sessionStorage.getItem('welcome_shown');
            if (hasSeen) {
                this.show = false;
                return;
            }
            sessionStorage.setItem('welcome_shown', 'true');
            setTimeout(() => {
                this.show = false;
            }, 3800);
        }
    }));

    Alpine.data('savedAccounts', () => ({
        accounts: [],
        init() {
            const stored = localStorage.getItem('saved_accounts');
            if (stored) {
                try {
                    this.accounts = JSON.parse(stored);
                } catch (e) {
                    this.accounts = [];
                }
            }
            const emailInput = document.getElementById('email');
            if (emailInput && this.accounts.length > 0) {
                const firstEmail = this.accounts[0];
                if (!emailInput.value) {
                    emailInput.value = firstEmail;
                }
            }
        },
        selectAccount(email) {
            document.getElementById('email').value = email;
            document.getElementById('password').focus();
        },
        removeAccount(email) {
            this.accounts = this.accounts.filter(a => a !== email);
            localStorage.setItem('saved_accounts', JSON.stringify(this.accounts));
        }
    }));

    Alpine.data('switchAccount', () => ({
        confirmSwitch: false,
        doSwitch() {
            sessionStorage.removeItem('welcome_shown');
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = document.getElementById('logout-form')?.action || '/logout';
            const csrf = document.querySelector('meta[name="csrf-token"]')?.content;
            if (csrf) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = '_token';
                input.value = csrf;
                form.appendChild(input);
            }
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = '_method';
            input.value = 'POST';
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    }));

});

Alpine.start();
