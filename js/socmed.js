let currentPage = 0;

function validateStep1() {
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;

    let isValid = true;

    // Full Name validation
    if (!name.trim()) {
        document.getElementById('name-error').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('name-error').style.display = 'none';
    }

    // Email validation
    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if (!email.match(emailPattern)) {
        document.getElementById('email-error').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('email-error').style.display = 'none';
    }

    // Phone number validation
    const phonePattern = /^[0-9]{10,12}$/;
    if (!phone.match(phonePattern)) {
        document.getElementById('phone-error').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('phone-error').style.display = 'none';
    }

    if (isValid) {
        nextPage();
    }
}

function validateStep2() {
    const packageSelect = document.getElementById('package');
    const checkinDate = document.getElementById('checkin').value;
    const guests = document.getElementById('guests').value;
    const days = document.getElementById('days').value;

    let isValid = true;

    // Validate package selection
    if (packageSelect.value === "") {
        alert("Package selection is required.");
        isValid = false;
    }

    // Validate check-in date
    if (!checkinDate) {
        alert("Check-in date is required.");
        isValid = false;
    }

    // Validate number of guests
    if (guests <= 0) {
        alert("Number of guests must be greater than zero.");
        isValid = false;
    }

    // Validate number of days
    if (days <= 0) {
        alert("Number of days must be greater than zero.");
        isValid = false;
    }

    if (isValid) {
        nextPage();
    }
}

function validateStep3() {
    const paymentSelect = document.getElementById('payment');
    const amount = document.getElementById('amount').value;
    const reference = document.getElementById('Reference').value;

    let isValid = true;

    // Validate payment method selection
    if (paymentSelect.value === "") {
        alert("Payment method is required.");
        isValid = false;
    }

    // Validate down payment amount
    if (amount <= 0) {
        alert("Down payment must be greater than zero.");
        isValid = false;
    }

    // Validate reference number
    if (!reference.trim()) {
        alert("Reference number is required.");
        isValid = false;
    }

    if (isValid) {
        nextPage();
    }
}

function nextPage() {
    const pages = document.querySelectorAll('.page');
    const steps = document.querySelectorAll('.progress-bar .step');

    pages[currentPage].style.display = 'none';
    steps[currentPage].classList.remove('active');
    steps[currentPage].querySelector('.bullet').classList.remove('active');
    steps[currentPage].querySelector('.check').classList.remove('active');

    currentPage++;
    pages[currentPage].style.display = 'block';
    steps[currentPage].classList.add('active');
    steps[currentPage].querySelector('.bullet').classList.add('active');
    steps[currentPage].querySelector('p').classList.add('active');
}

function prevPage() {
    const pages = document.querySelectorAll('.page');
    const steps = document.querySelectorAll('.progress-bar .step');

    pages[currentPage].style.display = 'none';
    steps[currentPage].classList.remove('active');
    steps[currentPage].querySelector('.bullet').classList.remove('active');
    steps[currentPage].querySelector('.check').classList.remove('active');

    currentPage--;
    pages[currentPage].style.display = 'block';
    steps[currentPage].classList.add('active');
    steps[currentPage].querySelector('.bullet').classList.add('active');
    steps[currentPage].querySelector('p').classList.add('active');
}

// Initial setup
const pages = document.querySelectorAll('.page');
const steps = document.querySelectorAll('.progress-bar .step');
pages.forEach((page, index) => {
    page.style.display = index === currentPage ? 'block' : 'none';
});
