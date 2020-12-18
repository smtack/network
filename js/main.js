var searchToggle = document.querySelector('.search-toggle');
var settingsToggle = document.querySelector('.settings-toggle');
var search = document.querySelector('.search');
var settings = document.querySelector('.settings');

window.onload = function() {
  search.style.display = "none";
  settings.style.display = "none";
}

searchToggle.addEventListener("click", function() {
  if(search.style.display == "none") {
    search.style.display = "block";
  } else {
    search.style.display = "none";
  }
});

settingsToggle.addEventListener("click", function() {
  if(settings.style.display == "none") {
    settings.style.display = "block";
  } else {
    settings.style.display = "none";
  }
});