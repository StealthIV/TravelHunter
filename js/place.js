let searchBox = document.querySelector('#search-box');
let municipalities = document.querySelectorAll('.florida');

searchBox.addEventListener('input', () => {
    console.log('start');
    let searchValue = searchBox.value.trim().toLowerCase();

    municipalities.forEach(municipality => {
        console.log('title');
        let title = municipality.querySelector('h1').textContent.toLowerCase();
        let cards = municipality.querySelectorAll('.card');

        if (searchValue === "" || title.includes(searchValue)) {
            // If the search input is empty or matches the municipality title, show both municipality and all its cards
            municipality.style.display = 'block';
            cards.forEach(card => {
                card.style.display = 'block';
            });
        } else {
            // Hide municipality if it doesn't match the search value
            municipality.style.display = 'none';

            // Loop through cards to show or hide based on search value
            cards.forEach(card => {
                console.log('card');
                let cardContent = card.querySelector('h1').textContent.toLowerCase();
                card.style.display = cardContent.includes(searchValue) ? 'block' : 'none';
            });
        }
    });
});