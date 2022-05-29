let gemIdsDiv = document.querySelectorAll('.gem-id');
let gemIds = [];
gemIdsDiv.forEach(id => {
    gemIds.push(id.textContent);
})
let rows = document.querySelectorAll('tr');
rows = Array.prototype.slice.call(rows);

let quantityLess = document.querySelectorAll(".quantity-less");

if (quantityLess != undefined) {
    quantityLess.forEach(element => {
        element.addEventListener('click', () => {
            let quantityDiv = element.previousElementSibling;
            // get index row of the specific tr
            let indexRow = element.parentElement.parentElement.parentElement.sectionRowIndex;
            let quant = Number(quantityDiv.textContent);
            makeRequest({id: gemIds[indexRow], quantity: -1}, "../php/modify_order.php");
            makeRequest({id: gemIds[indexRow], quantity: 1}, "../php/modify_stock.php");
            if (rows.length == 1)
                 clearTable();
            quant -= 1;
            quantityDiv.textContent = quant;
            items = document.querySelectorAll('.cart-item');
            if(items.length >= 5) {
                items[4].style.removeProperty('display');
            }     
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
                makeRequest({id: gemIds[indexRow], quantity: 1}, "../php/modify_order.php");
                makeRequest({id: gemIds[indexRow], quantity: -1}, "../php/modify_stock.php");
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
            // get index row of the specific tr
            let indexRow = row.sectionRowIndex;
            let quant = Number(quantityDiv.textContent);
            makeRequest({id: gemIds[indexRow], quantity: quant * (-1)}, "../php/modify_order.php");
            makeRequest({id: gemIds[indexRow], quantity: quant}, "../php/modify_stock.php");
            if (rows.length == 1)
                clearTable();
            items = document.querySelectorAll('.cart-item');
            if(items.length >= 5) {
                items[4].style.removeProperty('display');
            }     
        })
    })
}

let removeOrder = document.querySelector('#remove-order');

if (removeOrder != undefined) {
    removeOrder.addEventListener('click', () => {
        removeItem.forEach(element => {
            let quantityDiv = element.previousElementSibling.firstElementChild;
            // get index row of the specific tr
            let quant = Number(quantityDiv.textContent);
            makeRequest({id: gemIds[0], quantity: quant * (-1)}, "../php/modify_order.php");
            makeRequest({id: gemIds[0], quantity: quant}, "../php/modify_stock.php");
        })
        clearTable();
    })
}

let cartItems = document.querySelectorAll('.cart-item');

function clearTable() {
    document.getElementById('cart-items-nb').remove();
    document.getElementById('cart-content').innerHTML = '';
    let orderContent = document.getElementById("order-content");
    orderContent.innerHTML = "<h1 style='margin: 8% auto;'>Your cart is empty</h1>"+
    "<div id='div-btn-journey' style='margin-bottom: 40px'>"+
        "<a href='/category.php'>Visit our shop !</a>"+
    "</div>";
}


// AJAX stock gestion 

let xhr;

function makeRequest(data, file) {
    xhr = new XMLHttpRequest();
    if (!xhr) {
        console.log("Abort: Unable to create an instance of XMLHTTP");
        return false;
    }
    xhr.onreadystatechange = function () {
        if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200){
            console.log(xhr.responseText);
            if (file == "../php/modify_order.php" && xhr.responseText == "quantity null"){
                console.log(xhr.responseText);
                document.getElementById('cart-items-nb').textContent -= 1;
                cartItems.forEach(itemDiv => {
                    if (itemDiv.children[1].textContent == data['id']){
                        $gemIdIndex = gemIds.indexOf((data["id"]));
                        itemDiv.remove();
                        rows[$gemIdIndex + 1].remove();
                        rows.splice($gemIdIndex, 1)
                        gemIds.splice($gemIdIndex, 1);
                    }
                })
            }
        } else (xhr.status == 404)
    }
    xhr.open('POST', file, false);
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

//affichage du total dynamique
//let allprices = document.querySelectorAll(".case-price");
//let totalprice = 0;
//allprices.forEach(function(price){
//    totalprice = totalprice + parseInt(price.textContent)
//});
//document.getElementById("totalcalcul").textContent = totalprice;



