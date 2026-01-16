const textarea = document.querySelector('#post_content');
const commentTextarea = document.querySelector('#comment_text');
const bioTextarea = document.querySelector('#user_bio');
const submit = document.querySelector('#submit');
const counter = document.querySelector('#counter');

const fileUpload = document.querySelector('#post_image');
const fileName = document.querySelector('#file-name');

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
      submit.style.backgroundColor = "#ff0000";
      submit.style.color = "#FFFFFF";
      submit.style.borderColor = "#FF0000";
      submit.disabled = false;
    }
  })
}

if(commentTextarea) {
  counter.innerHTML = commentTextarea.value.length;

  commentTextarea.addEventListener('keyup', () => {
    counter.innerHTML = commentTextarea.value.length;

    if(commentTextarea.value.length > 500) {
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

if(bioTextarea) {
  counter.innerHTML = bioTextarea.value.length;

  bioTextarea.addEventListener('keyup', () => {
    counter.innerHTML = bioTextarea.value.length;

    if(bioTextarea.value.length > 250) {
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