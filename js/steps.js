
const nextButtons = document.querySelectorAll('.next');
const prevButtons = document.querySelectorAll('.prev');
const pages = document.querySelectorAll('.page');
const steps = document.querySelectorAll('.step');

let currentPage = 0;

function updateProgress() {
    steps.forEach((step, index) => {
        const bullet = step.querySelector('.bullet');
        const check = step.querySelector('.check');
        const label = step.querySelector('p');

        if (index < currentPage) {
            bullet.classList.add('active');
            check.classList.add('active');
            label.classList.add('active');
        } else if (index === currentPage) {
            bullet.classList.add('active');
            check.classList.add('active');
            label.classList.add('active');
        } else {
            bullet.classList.remove('active');
            check.classList.remove('active');
            label.classList.remove('active');
        }
    });
}

nextButtons.forEach(button => {
    button.addEventListener('click', (e) => {
        e.preventDefault();
        if (currentPage < pages.length - 1) {
            pages[currentPage].style.display = 'none';
            currentPage++;
            pages[currentPage].style.display = 'block';
            updateProgress();
        }
    });
});

prevButtons.forEach(button => {
    button.addEventListener('click', (e) => {
        e.preventDefault();
        if (currentPage > 0) {
            pages[currentPage].style.display = 'none';
            currentPage--;
            pages[currentPage].style.display = 'block';
            updateProgress();
        }
    });
});

// Initial state
pages.forEach((page, index) => {
    page.style.display = index === currentPage ? 'block' : 'none';
});