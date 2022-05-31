const toggleMenu = document.querySelector('#toggle-menu');
const menu = document.querySelector('.menu');

const toggleSearch = document.querySelector('#toggle-search');
const search = document.querySelector('.search');

window.onload = () => {
  menu.style.display = "none";
}

toggleMenu.addEventListener('click', () => {
  if(menu.style.display == "none") {
    menu.style.display = "block";
    toggleMenu.style.border = "2px solid red";
  } else {
    menu.style.display = "none";
    toggleMenu.style.border = "none";
  }
})

toggleSearch.addEventListener('click', () => {
  if(search.style.display == "block") {
    search.style.display = "none";
  } else {
    search.style.display = "block";
  }
})