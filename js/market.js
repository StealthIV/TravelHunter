// Elements
const packageSelect = document.getElementById('item');
const quantityInput = document.getElementById('quantity');
const downpaymentInput = document.getElementById('downpayment');
const balanceInput = document.getElementById('balance');

// Function to calculate and update the downpayment and balance
function updateAmounts() {
    // Extract the numeric value from the selected package (e.g., "Shell Keychains - ₱500" -> 500)
    const packageText = packageSelect.value;
    const packageAmount = parseFloat(packageText.match(/₱(\d+)/)[1]) || 0; // Extracts the numeric value

    // Get the quantity from the input field, default to 1 if not set
    const quantity = parseInt(quantityInput.value) || 1;

    // Calculate total amount for the selected quantity
    const totalAmount = packageAmount * quantity;

    // Calculate downpayment (30% of the total amount)
    const downpayment = totalAmount * 0.30;
    downpaymentInput.value = "₱" + downpayment.toFixed(2); // Format as currency

    // Calculate balance (remaining 70% of the total amount)
    const balance = totalAmount - downpayment;
    balanceInput.value = "₱" + balance.toFixed(2); // Format as currency
}

// Event listeners to trigger the update when package or quantity changes
packageSelect.addEventListener('change', updateAmounts);
quantityInput.addEventListener('input', updateAmounts);
