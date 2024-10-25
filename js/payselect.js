// Elements
const packageSelect = document.getElementById('package');
const quantityInput = document.getElementById('guests');
const downpaymentInput = document.getElementById('amount');
const balanceInput = document.getElementById('balance');

// Function to calculate and update the downpayment and balance
function updateAmounts() {
    const packageAmount = parseFloat(packageSelect.value) || 0;
    const quantity = parseInt(quantityInput.value) || 1;

    // Calculate total amount for the selected quantity
    const totalAmount = packageAmount * quantity;

    // Calculate downpayment (30% of the total amount)
    const downpayment = totalAmount * 0.30;
    downpaymentInput.value = "₱" + downpayment.toFixed(2);

    // Calculate balance (remaining 70% of the total amount)
    const balance = totalAmount - downpayment;
    balanceInput.value = "₱" + balance.toFixed(2);
}

// Event listeners to trigger the update when package or quantity changes
packageSelect.addEventListener('change', updateAmounts);
quantityInput.addEventListener('input', updateAmounts);
