const toggleMenu = document.querySelector('#toggle-menu');
const menu = document.querySelector('.menu');

const toggleSearch = document.querySelector('#toggle-search');
const search = document.querySelector('.search');

const content = document.querySelector('.content');

const textarea = document.querySelector('.post-content');
const commentTextArea = document.querySelector('.comment-text');
const submit = document.querySelector('#submit');
const counter = document.querySelector('#counter');

const fileUpload = document.querySelector('#post_image');
const fileName = document.querySelector('#file-name');

window.onload = () => {
  menu.style.display = "none";
  search.style.display = "none";
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
  if(search.style.display == "none") {
    search.style.display = "block";
    content.style.marginTop = "100px";
  } else {
    search.style.display = "none";
    content.style.marginTop = "25px";
  }
})

if(textarea) {
  counter.innerHTML = textarea.value.length;

  textarea.addEventListener('keyup', () => {
    counter.innerHTML = textarea.value.length;

    if(textarea.value.length > 1000) {
      counter.style.color = "#FF0000";
      submit.style.backgroundColor = "#818181";
      submit.style.color = "#FFFFFF";
      submit.style.borderColor = "#818181";
      submit.disabled = true;
    } else {
      counter.style.color = "#000000";
      submit.style.backgroundColor = "#FF0000";
      submit.style.color = "#FFFFFF";
      submit.style.borderColor = "#FF0000";
      submit.disabled = false;
    }
  })
}

if(commentTextArea) {
  counter.innerHTML = commentTextArea.value.length;

  commentTextArea.addEventListener('keyup', () => {
    counter.innerHTML = commentTextArea.value.length;

    if(commentTextArea.value.length > 500) {
      counter.style.color = "#FF0000";
      submit.style.backgroundColor = "#818181";
      submit.style.color = "#FFFFFF";
      submit.style.borderColor = "#818181";
      submit.disabled = true;
    } else {
      counter.style.color = "#000000";
      submit.style.backgroundColor = "#FF0000";
      submit.style.color = "#FFFFFF";
      submit.style.borderColor = "#FF0000";
      submit.disabled = false;
    }
  })
}

if(fileUpload) {
  fileUpload.addEventListener('change', () => {
    fileName.innerHTML = fileUpload.files[0].name;
  })
}

if(submit) {
  submit.addEventListener('mouseover', () => {
    submit.style.backgroundColor = "#FFFFFF";
    submit.style.color = "#FF0000";
  })

  submit.addEventListener('mouseout', () => {
    submit.style.backgroundColor = "#FF0000";
    submit.style.color = "#FFFFFF";
  })
}