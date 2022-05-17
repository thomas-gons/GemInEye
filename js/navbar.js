function resizePageContent(mode) {
    let pageContent = document.getElementById('page-content');
    console.log(pageContent);
    pageContent.style.width = (mode === true) ? '87vw': '91vw';
}


// Sidebar nav menu dropdown button
let sideBar = document.querySelector('#side-nav');
let menu = document.querySelector("#side-nav-menu-img");

let dropdown = document.querySelector(".dropdown-btn");
let dropdownContainer = document.querySelector(".dropdown-container");


menu.addEventListener("click", () => {
    if (sideBar.classList.contains("active")){
        if (dropdownContainer.classList.contains("active")){
            dropdownContainer.classList.remove("active");
        }
        sideBar.classList.remove("active");
        resizePageContent(false);
    }
    else {
        sideBar.classList.add("active");
        resizePageContent(true);
    }
})

dropdown.addEventListener("click", () => {
    if (sideBar.classList.contains("active")){
        if (dropdownContainer.classList.contains("active"))
            dropdownContainer.classList.remove("active");
        else {
            dropdownContainer.classList.add("active");
        }
    } else {
        sideBar.classList.add('active');
        dropdownContainer.classList.add('active');
    }
})

