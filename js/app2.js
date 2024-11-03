let currentIndex = 3; // Index of the selected slide (0-based)
const totalSlides = document.querySelectorAll('.slide').length;

document.getElementById('next').addEventListener('click', () => {
    changeSlide(1);
});

document.getElementById('prev').addEventListener('click', () => {
    changeSlide(-1);
});

function changeSlide(direction) {
    // Hide current slide
    document.querySelector(`#item_${currentIndex + 1}`).classList.remove('selected');

    // Update index
    currentIndex = (currentIndex + direction + totalSlides) % totalSlides;

    // Show new slide
    document.querySelector(`#item_${currentIndex + 1}`).classList.add('selected');
}
