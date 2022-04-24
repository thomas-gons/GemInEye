//Update quantity on click in product page
let quantitySpan = document.getElementById('quantity-span');
let stock = document.getElementById('stock');
const moreBtn = document.getElementById('quantity-more');
const lessBtn = document.getElementById('quantity-less');

moreBtn.addEventListener('click', function() {
    let quantity = Number(quantitySpan.textContent);
    if (quantity < Number(stock.value)) {
        quantity++;
        quantitySpan.textContent = quantity;
    }
});

lessBtn.addEventListener('click', function() {
    let quantity = Number(quantitySpan.textContent);
    if (quantity > 0) {
        quantity--;
        quantitySpan.textContent = quantity;
    }
});