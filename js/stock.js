let quantity = document.getElementById('quantity-span');

document.getElementById('quantity-less').addEventListener('click', () => {
    if (quantity.textContent > 1) {
        quantity.textContent = Number(quantity.textContent) - 1;
        document.getElementById('info-quantity').textContent = "";
    } else
        document.getElementById('info-quantity').textContent = "The quantity cannot be null";
})

document.getElementById('quantity-more').addEventListener('click', () => {
    if (Number(quantity.textContent) < Number(document.getElementById('stock').value)) {
        quantity.textContent = Number(quantity.textContent) + 1;
        document.getElementById('info-quantity').textContent = "";
    } else
        document.getElementById('info-quantity').textContent = "Maximum quantity available";
})

function addCart(){
    cartContent = document.querySelector("#cartContent").value = ""+
        document.querySelector('.gem-id').textContent+","+
        document.getElementById('gem-img').attributes[0].nodeValue+","+ // get image path from DOM
        document.querySelector('.gem-name').textContent+","+
        quantity.textContent+","+
        document.querySelector('#gem-price').textContent+",";
    
    changeStock({id: getGemID(), quantity: Number(quantity.textContent) * (-1)});
}

// AJAX stock gestion 

let xhr;

function changeStock (data) {
    xhr = new XMLHttpRequest();
    if (!xhr) {
        console.log("Abort: Unable to create an instance of XMLHTTP");
        return false;
    }
    xhr.onreadystatechange = function () {
        if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200){
            // ...
        } else (xhr.status == 404)
    }
    xhr.open('POST', "../php/modify_stock.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(formatData(data));
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