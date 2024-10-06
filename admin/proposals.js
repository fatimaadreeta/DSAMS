var p = document.getElementById("popup");
var i = document.getElementById("hiddenId");
var f = document.getElementById("file-viewer");
var c = document.getElementById("comment");
var b = document.getElementById("approvalButtons");

function review(id, file) {
  if (p.style.display === "none") {
    p.style.display = "flex";
    i.value = id;
    c.value = '';
    c.disabled = false;
    f.src = file;
    b.style.display = "flex";
  } else {asdf
    closePopUp();
  }
}

function review2(id) {
  if (p.style.display === "none") {
    p.style.display = "flex";
    i.value = id;
    c.value = '';
    c.disabled = false;
    b.style.display = "flex";
  } else {
    closePopUp();
  }
}

function view(comment, file) {
  if (p.style.display === "none") {
    p.style.display = "flex";
    c.value = comment;
    c.disabled = true;
    f.src = file;
    b.style.display = "none";
  } else {
    closePopUp();
  }
}

function view2(comment) {
  if (p.style.display === "none") {
    p.style.display = "flex";
    c.value = comment;
    c.disabled = true;
    b.style.display = "none";
  } else {
    closePopUp();
  }
}


function closePopUp(){
    p.style.display = "none";
    i.value = "";
    f.src = "";
    c.value = "";
    c.disabled = false;
}

function preventClose(event){
    event.stopPropagation();
}