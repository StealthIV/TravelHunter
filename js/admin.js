document.getElementById('admin-form').addEventListener('submit', (e) => {
    e.preventDefault();

    const title = document.getElementById('title').value;
    const image = document.getElementById('image').value;
    const history = document.getElementById('history').value;

    localStorage.setItem('title', title);
    localStorage.setItem('image', image);
    localStorage.setItem('history', history);

    alert('Content updated!');
});