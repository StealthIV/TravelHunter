// itenerary.js
document.getElementById('itineraryForm').addEventListener('submit', function (e) {
    e.preventDefault();
  
    const activity = document.getElementById('activity').value;
    const date = document.getElementById('date').value;
    const time = document.getElementById('time').value;
    const location = document.getElementById('location').value;
  
    // Prepare data to send via AJAX
    const formData = new FormData();
    formData.append('activity', activity);
    formData.append('date', date);
    formData.append('time', time);
    formData.append('location', location);
  
    // Send the data to the server
    fetch('itenerary.php', {
      method: 'POST',
      body: formData
    })
      .then(response => response.text())
      .then(data => {
        if (data === 'success') {
          alert('Activity added successfully!');
          // Optionally, refresh the table or update the UI dynamically
        } else {
          alert('Error saving activity.');
        }
      })
      .catch(error => {
        console.error('Error:', error);
      });
  });
  