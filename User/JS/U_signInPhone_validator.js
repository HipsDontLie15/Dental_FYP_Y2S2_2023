// phone requirement
const phoneInput = document.getElementById("phoneInput");
const phoneError = document.getElementById("phoneError");

function updatePhoneError() {
  if (phoneInput.validity.valid) {
    phoneError.classList.remove("form__error");
    phoneError.classList.add("form__ok");
  } else {
    phoneError.classList.remove("form__ok");
    phoneError.classList.add("form__error");
  }
}

phoneInput.addEventListener("input", updatePhoneError);

document.addEventListener("click", function (event) {
  const isClickedInsidePhoneInput = phoneInput.contains(event.target);
  if (isClickedInsidePhoneInput) {
    // Clicked inside phone input, show the error message if it's invalid
    updatePhoneError();
    phoneError.style.display = "block";
  } else {
    // Clicked outside phone input, hide the error message
    phoneError.style.display = "none";
  }
});