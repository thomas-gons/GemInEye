let buttonAddToCart = document.querySelectorAll('.add-cart-btn');

buttonAddToCart.forEach(button => {
    button.addEventListener('click', () => {
        let gemDiv = button.parentElement.previousElementSibling;
        let gemID = gemDiv.children[0].textContent;
        let gemImg = gemDiv.children[1].attributes[1].nodeValue
        let gemName = gemDiv.children[2].textContent.split(" ")[0]
        let data = gemID + "," + gemImg + "," + gemName + "," + 1 +","+
            gemDiv.children[4].textContent.substr(1);

        makeRequest({"cartContent": data});
    })
})
// AJAX stock gestion 

let xhr;

function makeRequest(data) {
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
    xhr.open("POST", "../php/order.php", true);
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