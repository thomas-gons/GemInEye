//Deleteing an Item
document.getElementById("deleteItems").addEventListener("click", ()=> {
    idItem = document.getElementById("items").value;
    indexOption = document.getElementById("items").selectedIndex; // On recupere l'index de l'option choisi
    document.getElementById("items").remove(indexOption); // on l'enleve
    makeRequest({id: idItem, mode: "removeItem"},"php/modify_admin.php");
})

//Deleting a category
document.getElementById('deleteCategory').addEventListener("click", ()=> {
    idCategory = document.getElementById("category").value;
    indexOption = document.getElementById("category").selectedIndex; // On recupere l'index de l'option choisi
    document.getElementById("category").remove(indexOption); // on l'enleve
    makeRequest({id: idCategory, mode: "removeCategory"}, "php/modify_admin.php")
})

// Adding in item

document.querySelectorAll(".addItems-input").forEach(input => {
    input.addEventListener("click", () => {
        input.value = "";
        input.style.color = "black";
        input.style.border = "1px solid black";
    })
})

document.getElementById('addItems').addEventListener("click", () => {
    document.getElementById("addItems-popup").classList.toggle("active");
    document.getElementById("securityAdd").classList.toggle("active");
})

document.getElementById('securityAdd').addEventListener("click", () => {
    let categoryItem = document.getElementById("addItems-category").value;
    let inCategories = false;
    document.querySelectorAll(".option").forEach(category => {
        if (categoryItem[0].toUpperCase() == category.value)
            inCategories = true;
    })
    if (!inCategories) {
        inputError(document.getElementById("addItems-category"), "must be an existing category");
        return;
    }
    let nameItem = document.getElementById("addItems-name").value;
    let descriptionItem = document.getElementById("addItems-description").value;
    let originItem = document.getElementById("addItems-origin").value;
    let imgItem = document.getElementById("addItems-img").value;
    let urlItem = document.getElementById("addItems-url").value;
    let quantityItem = document.getElementById("addItems-quantity").value;
    let priceItem = document.getElementById("addItems-price").value;
    makeRequest({category: categoryItem, name: nameItem, description: descriptionItem, origin: originItem,
        img: imgItem, url: urlItem, quantity: quantityItem, price: priceItem, mode: "addItems"}, "php/modify_admin.php");

})

function inputError(element, message) {
    element.value = message;
    element.style.color = "red";
    element.style.border = "1px solid red";
}

//Modifying property of an item --------------------------------------------------------

document.getElementById('modifyItems').addEventListener("click", () => {
    document.getElementById("property").classList.toggle("active");
})

document.getElementById("property").addEventListener("change", ()=> { 
    document.getElementById("modifyItemsStep2").style.visibility = "visible";
    document.getElementById("securityModify").style.visibility = "visible";
    document.getElementById("modifyItemsStep2").placeholder = document.getElementById('property').value;
})

document.getElementById("securityModify").addEventListener("click", ()=> {
    idItem = document.getElementById("items").value;
    properties = document.getElementById('property').value;
    content = document.getElementById("modifyItemsStep2").value;
    if(properties == "name") {
        indexOption = document.getElementById("items").selectedIndex; // On recupere l'index de l'option choisi
        document.getElementById("items").children[indexOption].innerHTML = content; // on le change
    }
    makeRequest({id: idItem, property: properties, value: content, mode: "modifyItems"}, "php/modify_admin.php");
    
})

//Change Customer

document.getElementById("customerChange").addEventListener("change", ()=> {
    document.getElementById("modifyCustomerStep2").style.visibility = "visible";
    document.getElementById("securityCustomer").style.visibility = "visible";
    document.getElementById("modifyCustomerStep2").placeholder = document.getElementById('customerChange').value;
})

document.getElementById("securityCustomer").addEventListener('click', ()=> {
    idCustomer = document.getElementById("customer").value;
    propertiesCustomer = document.getElementById('customerChange').value;
    content = document.getElementById("modifyCustomerStep2").value;
    if(propertiesCustomer == "login") {
        indexOption = document.getElementById("customer").selectedIndex; // On recupere l'index de l'option choisi
        document.getElementById("customer").children[indexOption].innerHTML = content; // on le change
    }
    makeRequest({id: idCustomer, property: propertiesCustomer, value: content, mode: "modifyCustomer"}, "php/modify_admin.php");
})

document.getElementById('modifyCustomer').addEventListener("click", () => {
    document.getElementById("customerChange").classList.toggle("active");
})


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