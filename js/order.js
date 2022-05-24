//Display preview of cart
let cart_img = document.getElementById('cart-img-div');

cart_img.addEventListener('mouseover', () => {
    if (document.getElementById('cart-items') !== null)
        document.getElementById('cart-items').style.visibility = 'visible';
})
cart_img.addEventListener('mouseout', () => {
    if (document.getElementById('cart-items') !== null)
        document.getElementById('cart-items').style.visibility = 'hidden';
})

cart_img.addEventListener('click', () => {
    document.location.href = "cart.php";
})

//Change flex direction of log buttons
function flexDirChange() {
    let logDiv = document.getElementById('header-log');
    if (window.innerWidth <= 900)
        logDiv.style.flexDirection = "column-reverse";
    else
        logDiv.style.flexDirection = "row";
}
window.addEventListener("resize", flexDirChange);