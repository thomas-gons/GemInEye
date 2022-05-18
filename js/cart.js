let url = window.location.href;
let gemIDs = url.split('=');
let gemIds = gemIDs[1].split('+');


let quantityLess = document.querySelectorAll(".quantity-less");

if (quantityLess != undefined) {
    quantityLess.forEach(element => {
        element.addEventListener('click', () => {
            let quantityDiv = element.previousElementSibling;
            // get index row of the specific tr
            let indexRow = element.parentElement.parentElement.parentElement.sectionRowIndex;
            let quant = Number(quantityDiv.textContent);
            changeJSONfile({id: gemIds[indexRow], quantity: -1}, "../php/modify_order.php");
            changeJSONfile({id: gemIds[indexRow], quantity: 1}, "../php/modify_stock.php");
            if (quant > 1)
                quant -= 1;
            else {
                if (gemIds.length != 0) {
                    gemIds.splice(indexRow, 1);
                    window.history.pushState("", "Gem In Eye - Cart", "cart.php?id=" + gemIds.join("+"));
                    location.reload(true);
                } else
                    window.location.href = "index.php";
            }
            quantityDiv.textContent = quant;
        })
    })
}


let quantityMore = document.querySelectorAll(".quantity-more");

if (quantityMore != undefined) {
    quantityMore.forEach(element => {
        element.addEventListener('click', () => {
            stockQuantity = element.parentElement.parentElement.nextElementSibling.textContent;
            let quantityDiv = element.previousElementSibling.previousElementSibling;
            // get index row of the specific tr
            let indexRow = element.parentElement.parentElement.parentElement.sectionRowIndex;
            let quant = Number(quantityDiv.textContent);
            if (quant < stockQuantity) {
                quant += 1;
                changeJSONfile({id: gemIds[indexRow], quantity: 1}, "../php/modify_order.php");
                changeJSONfile({id: gemIds[indexRow], quantity: -1}, "../php/modify_stock.php");
            }
            quantityDiv.textContent = quant;            
        })    
    })
}

let removeItem = document.querySelectorAll(".remove-item");

if (removeItem != undefined) {
    removeItem.forEach(element => {
        element.addEventListener('click', () => {
            let quantityDiv = element.previousElementSibling.firstElementChild;
            let row = element.parentElement.parentElement;
            console.log(row);
            // get index row of the specific tr
            let indexRow = row.sectionRowIndex;
            let quant = Number(quantityDiv.textContent);
            changeJSONfile({id: gemIds[indexRow], quantity: quant * (-1)}, "../php/modify_order.php");
            changeJSONfile({id: gemIds[indexRow], quantity: quant}, "../php/modify_stock.php");
            gemIds.splice(indexRow, 1);
            if (gemIds.length != 0) {
                window.history.pushState("", "Gem In Eye - Cart", "cart.php?id=" + gemIds.join("+"));
                location.reload(true);
            } else
                window.location.href = "index.php";
        })
    })
}

let removeOrder = document.querySelector('#remove-order');

if (removeOrder != undefined) {
    removeOrder.addEventListener('click', () => {
        let lastRemoveItem = removeItem[removeItem.length - 1];
        removeItem.forEach(element => {
            let quantityDiv = element.previousElementSibling.firstElementChild;
            // get index row of the specific tr
            let quant = Number(quantityDiv.textContent);
            changeJSONfile({id: gemIds[0], quantity: quant * (-1)}, "../php/modify_order.php");
            changeJSONfile({id: gemIds[0], quantity: quant}, "../php/modify_stock.php");
            if (element != lastRemoveItem){
                gemIds.splice(0, 1);
                window.history.pushState("", "Gem In Eye - Cart", "cart.php?id=" + gemIds.join("+"));
            } else 
                window.location.href = "index.php";
        })
    })
}
// AJAX stock gestion 

let xhr;

function changeJSONfile (data, file) {
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
    xhr.open('POST', file, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(formatData(data));
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