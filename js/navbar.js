// Sidebar nav menu dropdown button
let dropdown = document.getElementsByClassName("dropdown-btn");

for (let i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        let dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "flex") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "flex";
        }
    });
}

let sideBar = document.querySelector('#side-nav');
let menu = document.querySelector("#side-nav-menu-img");
let logOut = document.querySelector("#side-nav-log-out");



menu.addEventListener("click", () => {
    sideBar.classList.toggle("active");
});
