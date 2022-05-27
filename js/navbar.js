function resizePageContent(mode) {
    let pageContent = document.getElementById('page-content');
    if (mode === true) {
        pageContent.classList.add("resize");
        pageContent.style.minWidth = "600px";
        // for homepage
        if (mainContainers = document.querySelectorAll(".main-container")) {
            mainContainers.forEach(c => {
                c.style.minWidth = "600px";
            });
        }
    } else {
        pageContent.classList.remove("resize");
        pageContent.style.minWidth = "735px";
        // for homepage
        if (mainContainers = document.querySelectorAll(".main-container")) {
            mainContainers.forEach(c => {
                c.style.minWidth = "735px";
            });
        }
    }
}

// Sidebar nav menu and dropdown button
let sideBar = document.querySelector('#side-nav');
let menu = document.querySelector("#side-nav-menu-img");

let dropdown = document.querySelector(".dropdown-btn");
let dropdownContainer = document.querySelector(".dropdown-container");

// Open or close sidebar nav menu
menu.addEventListener("click", () => {
    if (sideBar.classList.contains("active")){
        if (dropdownContainer.classList.contains("active")){
            dropdownContainer.classList.remove("active");
        }
        sideBar.classList.remove("active");
        resizePageContent(false);
    } else {
        sideBar.classList.add("active");
        resizePageContent(true);
    }
});

// Open or close dropdown menu
dropdown.addEventListener("click", () => {
    if (sideBar.classList.contains("active")){
        if (dropdownContainer.classList.contains("active")) {
            dropdownContainer.classList.remove("active");
        } else {
            dropdownContainer.classList.add("active");
        }
    } else {
        sideBar.classList.add('active');
        dropdownContainer.classList.add('active');
    }
});