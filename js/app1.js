const nextBtn = document.querySelector('.next');
const prevBtn = document.querySelector('.prev');

const slider = document.querySelector('.slider');
const sliderList = slider.querySelector('.list');
const thumbnail = document.querySelector('.thumbnail');
const thumbnailItems = Array.from(thumbnail.querySelectorAll('.item'));

// Initial setup: appending the first thumbnail item to the thumbnail list
thumbnail.appendChild(thumbnailItems[0]);

// Event listener for the next button
nextBtn.addEventListener('click', () => moveSlider('next'));

// Event listener for the previous button
prevBtn.addEventListener('click', () => moveSlider('prev'));

// Make each thumbnail item clickable
thumbnailItems.forEach((item) => {
    item.addEventListener('click', () => moveSliderToItem(item));
});

// Function to move the slider in the specified direction
function moveSlider(direction) {
    const sliderItems = Array.from(sliderList.querySelectorAll('.item'));
    const thumbnailItems = Array.from(thumbnail.querySelectorAll('.item'));

    if (direction === 'next') {
        sliderList.appendChild(sliderItems[0]);
        thumbnail.appendChild(thumbnailItems[0]);
        slider.classList.add('next');
    } else {
        sliderList.prepend(sliderItems[sliderItems.length - 1]);
        thumbnail.prepend(thumbnailItems[thumbnailItems.length - 1]);
        slider.classList.add('prev');
    }

    slider.addEventListener('animationend', () => {
        slider.classList.remove(direction === 'next' ? 'next' : 'prev');
    }, { once: true });
}

// Function to move the slider to a specific item when clicked
function moveSliderToItem(clickedItem) {
    const sliderItems = Array.from(sliderList.querySelectorAll('.item'));
    const clickedIndex = thumbnailItems.indexOf(clickedItem);

    // Move the slider to match the clicked thumbnail
    while (sliderList.firstChild !== sliderItems[clickedIndex]) {
        sliderList.appendChild(sliderList.firstChild);
        thumbnail.appendChild(thumbnail.firstChild);
    }
    slider.classList.add('selected');

    // Add and remove the 'selected' class to highlight the clicked item
    thumbnailItems.forEach(item => item.classList.remove('selected'));
    clickedItem.classList.add('selected');
}
