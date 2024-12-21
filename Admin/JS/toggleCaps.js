var capsMsg = document.getElementById("caps");

window.addEventListener("keydown", function(event) {  

if (event.getModifierState("CapsLock")) {
    capsMsg.style.display = "block";
  } else {
    capsMsg.style.display = "none"
  }
}

);