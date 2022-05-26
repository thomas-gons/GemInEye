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

//Modifying property of an item --------------------------------------------------------

document.getElementById('modifyItems').addEventListener("click", ()=> {
    document.getElementById("property").classList.toggle("active");
    // if (.style.visibility == "hidden") {
    //     document.getElementById("property").style.visibility = "visible";
    // } else {
    //     document.getElementById("property").style.visibility = "hidden";
    // }
    
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