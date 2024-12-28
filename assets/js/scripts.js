// Handle "Add to Basket" button clicks
document.querySelectorAll('.add-to-basket-btn').forEach(button => {
    button.addEventListener('click', function (e) {
        e.preventDefault(); // Prevent default behavior

        // Get the food ID, price, and quantity
        const foodId = this.getAttribute('data-id');
        const pricePerUnit = parseFloat(this.getAttribute('data-price'));
        const quantityInput = document.getElementById(`quantity-${foodId}`);
        const quantity = parseInt(quantityInput?.value) || 1; // Default to 1 if not provided
        const totalPrice = pricePerUnit * quantity; // Calculate total price for the item

        // Update the sessionStorage basket
        let basket = JSON.parse(sessionStorage.getItem('basket')) || []; // Get current basket or initialize it
        const existingItem = basket.find(item => item.id === foodId);

        if (existingItem) {
            // Update quantity and totalPrice if item already exists
            existingItem.quantity += quantity;
            existingItem.totalPrice += totalPrice;
        } else {
            // Add new item to the basket
            basket.push({ id: foodId, quantity, totalPrice });
        }

        sessionStorage.setItem('basket', JSON.stringify(basket)); // Save updated basket

        // Show success notification
        const successPopup = document.getElementById('success-popup');
        successPopup.textContent = `${quantity} Ürün(ler)i sepete Eklendi`; // Dynamic message
        successPopup.style.display = 'block'; // Show the popup
        setTimeout(() => {
            successPopup.style.display = 'none'; // Hide the popup after 3 seconds
        }, 3000);

        // Update the button style
        this.textContent = "Eklendi";
        this.classList.add('clicked');
        this.disabled = true; // Prevent double-clicks

        // Send the food data to the backend
        fetch('./php/add_to_basket.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: foodId, quantity, totalPrice })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Update the basket count in the header
                const basketCount = document.querySelector('.basket-count');
                const currentCount = parseInt(basketCount.textContent) || 0;
                basketCount.textContent = currentCount + quantity; // Add quantity to the basket count
            } else {
                console.error('Ürün sepete eklenemedi.');
            }
        })
        .catch(err => console.error('Error:', err));
    });
});


















// Handle "Order All" button click to show address popup
document.getElementById('order-all-btn').addEventListener('click', function () {
    document.getElementById('address-popup').classList.add('show'); // Show address popup
});

// Handle address form submission
document.getElementById('address-form').addEventListener('submit', function (e) {
    e.preventDefault();
    document.getElementById('address-popup').classList.remove('show');
    document.getElementById('payment-popup').classList.add('show'); // Show payment popup
});
















// Handle payment form submission
document.getElementById('payment-form').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent default form submission

    // Retrieve basket from sessionStorage
    const basket = JSON.parse(sessionStorage.getItem('basket')) || [];

    // Check if the basket is empty
    if (basket.length === 0) {
        alert("Sepetiniz boş! Lütfen sipariş vermeden önce birkaç ürün ekleyin.");
        return;
    }

    // Collect form data
    const address = document.getElementById('address').value;
    const cardNumber = document.getElementById('card-number').value;
    const cvv = document.getElementById('cvv').value;
    const expiry = document.getElementById('expiry').value;
    const phone = document.getElementById('phone').value;
    const state = document.getElementById('state').value;
    const apartment = document.getElementById('apartment').value;

    // Combine address and apartment for a full address
    const fullAddress = `${address}, ${apartment}, ${state}`;

    // Send data to the backend
    fetch('php/order.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            basket: basket,          // Send the basket
            address: fullAddress,    // Full address
            cardNumber: cardNumber,  // Card number
            cvv: cvv,                // CVV
            expiry: expiry,          // Expiry date
            phone: phone             // Phone number
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Sipariş başarıyla verildi!');
            sessionStorage.removeItem('basket'); // Clear the basket from sessionStorage
            window.location.href = 'main_page.php'; // Redirect to the main page
        } else {
            alert(`Failed to place order: ${data.message}`);
        }
    })
    .catch(err => console.error('Error:', err));
});



















// Update totals when quantity changes
document.querySelectorAll('.qty-input').forEach(input => {
    input.addEventListener('input', function () {
        const id = this.getAttribute('data-id');
        const price = parseFloat(this.getAttribute('data-price'));
        const quantity = parseInt(this.value);

        // Update total for this row
        const row = this.closest('tr');
        const itemTotal = row.querySelector('.item-total');
        itemTotal.textContent = `$${(price * quantity).toFixed(2)}`;

        // Recalculate overall total
        updateTotalPrice();
    });
});

function updateTotalPrice() {
    let total = 0;
    document.querySelectorAll('.item-total').forEach(totalCell => {
        total += parseFloat(totalCell.textContent.replace('$', ''));
    });
    document.getElementById('total-price').textContent = total.toFixed(2);
}


// Handle Remove button clicks
document.querySelectorAll('.remove-btn').forEach(button => {
    button.addEventListener('click', function () {
        const row = this.closest('tr');
        const id = row.getAttribute('data-id');

        // Remove row
        row.remove();

        // Recalculate total price
        updateTotalPrice();

        // Update backend session
        fetch('php/remove_from_basket.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id })
        }).then(response => response.json())
          .then(data => {
              if (data.status !== 'success') {
                  alert('Öğeyi sepetten çıkarma başarısız oldu.');
              }
          });
    });
});

