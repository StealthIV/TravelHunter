document.addEventListener('DOMContentLoaded', () => {
    const title = localStorage.getItem('title');
    const image = localStorage.getItem('image');
    const history = localStorage.getItem('history');

    if (title) document.getElementById('page-title').textContent = title;
    if (image) document.getElementById('slider-image').src = image;
    if (history) document.getElementById('history-text').textContent = history;
});