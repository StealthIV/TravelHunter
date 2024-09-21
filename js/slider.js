let currentSlide = 0;

function moveSlide(direction) {
    const slides = document.querySelectorAll('.slides img');
    currentSlide += direction;

    if (currentSlide >= slides.length) {
        currentSlide = 0;
    } else if (currentSlide < 0) {
        currentSlide = slides.length - 1;
    }

    const offset = -currentSlide * 100;
    slides.forEach((slide) => {
        slide.style.transform = `translateX(${offset}%)`;
    });
}
