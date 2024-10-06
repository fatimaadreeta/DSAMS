var p = document.getElementById("popup");
var i = document.getElementById("hiddenId");
var m = document.getElementById("message");

function review(id, name) {
  if (p.style.display === "none") {
    p.style.display = "flex";
    i.value = id;
    m.innerHTML = "Are you sure you want to remove <br>".concat(name, "?");
  } else {
    closePopUp();
  }
}

function closePopUp(){
  p.style.display = "none";
  i.value = "";
  m.innerHTML = "";
}

function preventClose(event){
  event.stopPropagation();
}