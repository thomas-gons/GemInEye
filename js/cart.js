let quantityLess = document.querySelectorAll(".quantity-less");
let quantityMore = document.querySelectorAll(".quantity-more");

quantityLess.forEach(element => {
    element.addEventListener('click', () => {
        quantity = Number(element.parentElement.previousElementSibling.textContent);
        if (quantity > 0) {
            quantity -= 1;
            // document.getElementById('info-quantity').textContent = "";
        }
            // document.getElementById('info-quantity').textContent = "The quantity is already null";
        element.parentElement.previousElementSibling.textContent = quantity;    
    })
});

quantityMore.forEach(element => {
    element.addEventListener('click', () => {
        stockQuantity = element.parentElement.parentElement.nextElementSibling.textContent;
        quantity = Number(element.parentElement.previousElementSibling.textContent);
        if (quantity < stockQuantity) {
            quantity += 1;
            // document.getElementById('info-quantity').textContent = "";
        }
            // document.getElementById('info-quantity').textContent = "Maximum quantity available";
            element.parentElement.previousElementSibling.textContent = quantity;
    })
    
})