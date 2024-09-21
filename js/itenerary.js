document.addEventListener('DOMContentLoaded', function() {
    loadItinerary();

    document.getElementById('itineraryForm').addEventListener('submit', function(event) {
        event.preventDefault();
        
        const activity = document.getElementById('activity').value;
        const date = document.getElementById('date').value;
        const time = document.getElementById('time').value;
        const location = document.getElementById('location').value;
        
        const itineraryItem = {
            id: Date.now(),
            activity: activity,
            date: date,
            time: time,
            location: location
        };
        
        addItineraryRow(itineraryItem);
        saveItinerary();
        document.getElementById('itineraryForm').reset();
    });
});

function loadItinerary() {
    const itinerary = JSON.parse(localStorage.getItem('itinerary')) || [];
    itinerary.forEach(item => addItineraryRow(item));
}

function saveItinerary() {
    const rows = Array.from(document.querySelectorAll('#itineraryTable tbody tr'));
    const itinerary = rows.map(row => {
        return {
            id: row.dataset.id,
            activity: row.querySelector('.activity').innerText,
            date: row.querySelector('.date').innerText,
            time: row.querySelector('.time').innerText,
            location: row.querySelector('.location').innerText
        };
    });
    localStorage.setItem('itinerary', JSON.stringify(itinerary));
}

function addItineraryRow(item) {
    const table = document.getElementById('itineraryTable').getElementsByTagName('tbody')[0];
    const newRow = table.insertRow();
    
    newRow.dataset.id = item.id;
    
    const activityCell = newRow.insertCell(0);
    const dateCell = newRow.insertCell(1);
    const timeCell = newRow.insertCell(2);
    const locationCell = newRow.insertCell(3);
    const actionsCell = newRow.insertCell(4);
    
    activityCell.innerHTML = `<div class="editable activity" contenteditable="true" oninput="saveItinerary()">${item.activity}</div>`;
    dateCell.innerHTML = `<div class="editable date" contenteditable="true" oninput="saveItinerary()">${item.date}</div>`;
    timeCell.innerHTML = `<div class="editable time" contenteditable="true" oninput="saveItinerary()">${item.time}</div>`;
    locationCell.innerHTML = `<div class="editable location" contenteditable="true" oninput="saveItinerary()">${item.location}</div>`;
    actionsCell.innerHTML = `<button onclick="editRow(this)">Edit</button>`;
    actionsCell.innerHTML = `<button onclick="deleteRow(this)">Delete</button>`;
}

function editableRow(button) {
    const row = button.editRow('tr');
    row.parentNode.editchild(row);
    saveItinerary();
}

function deleteRow(button) {
    const row = button.closest('tr');
    row.parentNode.removeChild(row);
    saveItinerary();
}
