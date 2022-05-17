let quantity = document.getElementById('quantity-span');

document.getElementById('quantity-less').addEventListener('click', () => {
    if (quantity.textContent > 0) {
        quantity.textContent = Number(quantity.textContent) - 1;
        document.getElementById('info-quantity').textContent = "";
    } else
        document.getElementById('info-quantity').textContent = "The quantity is already null";
})

document.getElementById('quantity-more').addEventListener('click', () => {
    if (quantity.textContent < document.getElementById('stock').value) {
        quantity.textContent = Number(quantity.textContent) + 1;
        document.getElementById('info-quantity').textContent = "";
    } else
        document.getElementById('info-quantity').textContent = "Maximum quantity available";
})

function addCart(){
    cartContent = document.querySelector("#cartContent").value = ""+
        document.getElementById('gem-img').attributes[0].nodeValue+","+ // get image path from DOM
        document.querySelector('.gem-id').textContent+","+
        document.querySelector('.gem-name').textContent+","+
        quantity.textContent+","+
        document.querySelector('#gem-price').textContent+",";
}

function check(){
    if (quantity.textContent == 0){
        // add warning message
        return false;
    }
    return true
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

// AJAX stock gestion 

let xhr;

function makeRequest (url, data) {
    xhr = new XMLHttpRequest();
    if (!xhr) {
        alert("Abort: Unable to create an instance of XMLHTTP");
        return false;
    }
    xhr.onreadystatechange = function () {
        if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200){
            // ...
        }
    }
    xhr.open("POST", url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded=utf-8'),
    xhr.send(data);
}