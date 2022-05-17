let quantity = document.getElementById('quantity-span');

document.getElementById('quantity-less').addEventListener('click', () => {
    if (quantity.textContent > 1) {
        changeStock((quantity.textContent == 2) ? -2: -1);
        quantity.textContent = Number(quantity.textContent) - 1;
        document.getElementById('info-quantity').textContent = "";
    } else
        document.getElementById('info-quantity').textContent = "The quantity cannot be null";
})

document.getElementById('quantity-more').addEventListener('click', () => {
    if (Number(quantity.textContent) < Number(document.getElementById('stock').value)) {
        changeStock((quantity.textContent == 1) ? 2: 1);
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
    if (quantity.textContent == 1){
        changeStock(1);
    }
    return true
}

// AJAX stock gestion 

let xhr;

function changeStock (dQuant) {
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
    xhr.open('POST', "../php/modify_stock.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(formatData({id: getGemID(), quantity: dQuant}));
}

function getGemID() {
    let url = window.location.href;
    let id = url.match(/gem\.php\?cat=(\w)&item=(\d)/);
    return id[1] + id[2];
}

function formatData(data){
    let formatedData = "";
    let lastElement = Object.keys(data).pop();
    
    for (let key in data){
        formatedData += key + "=" + data[key];
        if (key != lastElement)
            formatedData += "&";
    }
    return formatedData;
}