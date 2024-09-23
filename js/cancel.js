let currentPage = 0;

function validateStep1() {
    let isValid = true;

    // Full Name validation
    const name = document.getElementById('name').value.trim();
    if (name === "") {
        alert("Full Name is required.");
        isValid = false;
    }

    // Phone Number validation (example for 10-12 digits)
    const phone = document.getElementById('phone').value;
    const phonePattern = /^[0-9]{10,12}$/;
    if (!phone.match(phonePattern)) {
        alert("Valid Phone Number is required (10-12 digits).");
        isValid = false;
    }

    if (isValid) {
        nextPage();
    }
}

function validateStep2() {
    let isValid = true;

    // Request selection validation
    const requestSelect = document.getElementById('Request');
    if (requestSelect.value === "") {
        alert("Please choose a request.");
        isValid = false;
    }

    // Reason of Request validation
    const reason = document.getElementById('Reason').value.trim();
    if (reason === "") {
        alert("Reason for the request is required.");
        isValid = false;
    }

    if (isValid) {
        nextPage();
    }
}

function validateStep3() {
    let isValid = true;

    // Booking ID validation
    const bookingId = document.getElementById('Booking_Id').value;
    if (bookingId <= 0) {
        alert("Valid Booking ID is required.");
        isValid = false;
    }

    // Refund method selection validation
    const refundMethodSelect = document.getElementById('refundmethod');
    if (refundMethodSelect.value === "") {
        alert("Please choose a refund method.");
        isValid = false;
    }

    // Receiver Number validation
    const receiverNum = document.getElementById('receivernum').value;
    const receiverNumPattern = /^[0-9]{10,12}$/;
    if (!receiverNum.match(receiverNumPattern)) {
        alert("Valid Receiver Number is required (10-12 digits).");
        isValid = false;
    }

    // Re-Booking Date validation
    const rebookingDate = document.getElementById('rebooking').value;
    if (rebookingDate === "") {
        alert("Re-Booking Date is required.");
        isValid = false;
    }

    if (isValid) {
        nextPage();
    }
}

function validateStep4() {
    let isValid = true;

    // Username validation
    const username = document.querySelector('input[name="username"]').value.trim();
    if (username === "") {
        alert("Username is required.");
        isValid = false;
    }

    // Password validation
    const password = document.querySelector('input[name="password"]').value;
    if (password === "") {
        alert("Password is required.");
        isValid = false;
    }

    if (isValid) {
        document.getElementById('bookingForm').submit(); // Submit the form if all validations pass
    }
}

function nextPage() {
    const pages = document.querySelectorAll('.page');
    pages[currentPage].style.display = 'none';
    currentPage++;
    pages[currentPage].style.display = 'block';
}

// Initial state
const pages = document.querySelectorAll('.page');
pages.forEach((page, index) => {
    page.style.display = index === currentPage ? 'block' : 'none';
});

// Event listeners for next buttons
document.querySelector('.firstNext').addEventListener('click', (e) => {
    e.preventDefault(); // Prevent form submission
    validateStep1();
});

document.querySelector('.next-1').addEventListener('click', (e) => {
    e.preventDefault(); // Prevent form submission
    validateStep2();
});

document.querySelector('.next-2').addEventListener('click', (e) => {
    e.preventDefault(); // Prevent form submission
    validateStep3();
});

document.querySelector('.prev-1').addEventListener('click', (e) => {
    e.preventDefault();
    currentPage--;
    nextPage();
});

document.querySelector('.prev-2').addEventListener('click', (e) => {
    e.preventDefault();
    currentPage--;
    nextPage();
});

document.querySelector('.prev-3').addEventListener('click', (e) => {
    e.preventDefault();
    currentPage--;
    nextPage();
});

document.querySelector('.submit').addEventListener('click', (e) => {
    e.preventDefault(); // Prevent form submission
    validateStep4();
});
