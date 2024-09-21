function changeLanguage() {
    const selectedLanguage = document.getElementById('language-select').value;
    const elements = document.querySelectorAll('[data-lang-en]');

    elements.forEach(element => {
        const translation = element.getAttribute(`data-lang-${selectedLanguage}`);
        if (translation) {
            element.textContent = translation;
        }
    });
}
