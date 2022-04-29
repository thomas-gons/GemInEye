let cart_img = document.getElementById('cart-img-div');

cart_img.addEventListener('mouseover', () => {
    document.getElementById('cart-items').style.visibility = 'visible';
})

cart_img.addEventListener('mouseout', () => {
    document.getElementById('cart-items').style.visibility = 'hidden';
})

cart_img.addEventListener('click', () => {
    if (document.getElementById('cart-items') != undefined)
        window.location.href = 'cart.php';
})