// cancelbtn move to login form
const cancelBtn = document.getElementById("cancelBtn");

cancelBtn.addEventListener("click", () => {
  bContainer.classList.remove("right-panel-active");
});

// swap login and sign up form
const signInBtn = document.getElementById("signIn");
const signUpBtn = document.getElementById("signUp");
const fistForm = document.getElementById("form1");
const secondForm = document.getElementById("form2");
const bContainer = document.querySelector(".bContainer");

// initial login page
bContainer.classList.remove("right-panel-active");

// btn swapping
signInBtn.addEventListener("click", () => {
  bContainer.classList.remove("right-panel-active");
});

signUpBtn.addEventListener("click", () => {
  bContainer.classList.add("right-panel-active");
});