// dob requirement
const dobInput = document.getElementById("DOB");
const dobError = document.getElementById("dobError");

function updateDOBError() {
  if (dobInput.validity.valid) {
    dobError.classList.remove("form__error");
    dobError.classList.add("form__ok");
  } else {
    dobError.classList.remove("form__ok");
    dobError.classList.add("form__error");
  }
}

dobInput.addEventListener("input", updateDOBError);

document.addEventListener("click", function (event) {
  const isClickedInsidedobInput = dobInput.contains(event.target);
  if (isClickedInsidedobInput) {
    // Clicked inside phone input, show the error message if it's invalid
    updateDOBError();
    dobError.style.display = "block";
  } else {
    // Clicked outside phone input, hide the error message
    dobError.style.display = "none";
  }
});