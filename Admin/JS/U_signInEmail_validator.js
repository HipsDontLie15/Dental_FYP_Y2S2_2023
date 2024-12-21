// email verify
const emailInput = document.getElementById("c_email");
const emailError = document.getElementById("emailError");
const emailRegex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,50}$/i; // Case-insensitive regex

function updateEmailError() {
  if (emailInput.validity.valid && emailRegex.test(emailInput.value)) {
    emailError.classList.remove("form__error");
    emailError.classList.add("form__ok");
  } else {
    emailError.classList.remove("form__ok");
    emailError.classList.add("form__error");
  }

}

emailInput.addEventListener("input", updateEmailError);

document.addEventListener("click", function (event) {
  const isClickedInsideEmailInput = emailInput.contains(event.target);
  if (isClickedInsideEmailInput) {
    // Clicked inside email input, show the error message if it's invalid
    updateEmailError();
    emailError.style.display = "block";
  } else {
    // Clicked outside email input, hide the error message
    emailError.style.display = "none";
  }

  
});