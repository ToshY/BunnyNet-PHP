document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('pre code').forEach(el => {
        hljs.highlightElement(el);
    });
});
