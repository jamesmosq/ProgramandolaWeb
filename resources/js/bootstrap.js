// CSRF token para peticiones fetch/XHR
const token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.csrfToken = token.content;
}
