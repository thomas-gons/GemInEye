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

let httpRequest;

function makeRequest (url, data) {
    httpRequest = new XMLHttpRequest();
    if (!httpRequest) {
        alert("Abort: Unable to create an instance of XMLHTTP");
        return false;
    }
    httpRequest.onreadystatechange = function () {
        if (httpRequest.readyState == XMLHttpRequest.DONE && httpRequest.status == 200){
            // ...
        }
    }
    httpRequest.open("POST", url, true);
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded=utf-8'),
    httpRequest.send(data);
}