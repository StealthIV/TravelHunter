document.addEventListener('DOMContentLoaded', () => {
    const navbarToggle = document.getElementById('navbar-toggle');
    const navbarMenu = document.getElementById('navbar-menu');

    navbarToggle.addEventListener('click', () => {
        navbarMenu.classList.toggle('active');
    });

    const itineraryForm = document.getElementById('itinerary-form');
    const itineraryList = document.getElementById('itinerary-list');

    itineraryForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const destination = document.getElementById('destination').value;
        const date = document.getElementById('date').value;

        if (destination && date) {
            addItineraryItem(destination, date);
            saveItinerary();
        }
    });

    function addItineraryItem(destination, date) {
        const li = document.createElement('li');
        li.innerHTML = `
            <span>${destination} - ${date}</span>
            <div>
                <button class="edit">Edit</button>
                <button class="delete">Delete</button>
            </div>
        `;

        itineraryList.appendChild(li);

        const editButton = li.querySelector('.edit');
        const deleteButton = li.querySelector('.delete');

        editButton.addEventListener('click', () => editItineraryItem(li));
        deleteButton.addEventListener('click', () => deleteItineraryItem(li));
    }

    function editItineraryItem(item) {
        const [destination, date] = item.querySelector('span').textContent.split(' - ');
        document.getElementById('destination').value = destination;
        document.getElementById('date').value = date;
        item.remove();
        saveItinerary();
    }

    function deleteItineraryItem(item) {
        item.remove();
        saveItinerary();
    }

    function saveItinerary() {
        const items = [];
        itineraryList.querySelectorAll('li').forEach(li => {
            const [destination, date] = li.querySelector('span').textContent.split(' - ');
            items.push({ destination, date });
        });

        localStorage.setItem('itinerary', JSON.stringify(items));
    }

    function loadItinerary() {
        const items = JSON.parse(localStorage.getItem('itinerary') || '[]');
        items.forEach(item => addItineraryItem(item.destination, item.date));
    }

    loadItinerary();
});
