// Sidebar nav menu dropdown button
let sideBar = document.querySelector('#side-nav');
let menu = document.querySelector("#side-nav-menu-img");

let dropdown = document.querySelector(".dropdown-btn");
let dropdownContainer = document.querySelector(".dropdown-container");

menu.addEventListener("click", () => {
    if (sideBar.classList.contains("active")){
        if (dropdownContainer.classList.contains("active"))
            dropdownContainer.classList.remove("active");
        sideBar.classList.remove("active");
    }
    else 
        sideBar.classList.add("active");
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

// // à reprendre

// for (let i = 0; i < dropdown.length; i++) {
//     dropdown[i].addEventListener("click", () => {
//         if (!sideBar.classList.contains("active")){
//             sideBar.classList.toggle("active");
//             dropdownContainer.style.display = "flex";
//         } else {
        
//             this.classList.toggle("active");
//             let dropdownContainer = this.nextElementSibling;
//             if (dropdownContainer.style.display === "flex") {
//                 dropdownContainer.style.display = "none";
//             } else {
//                 dropdownContainer.style.display = "flex";
//             }
//         }
//     });
// }

// let logOut = document.querySelector("#side-nav-log-out");



// menu.addEventListener("click", () => {
//     if (sideBar.classList.contains("active")){
//         for (let i = 0; i < dropdown.length; i++){
//             if (dropdown[i].style.display === "flex"){
//                 dropdown[i].style.display = "none";
//             }
//         }
//     }
//     sideBar.classList.toggle("active");

// });