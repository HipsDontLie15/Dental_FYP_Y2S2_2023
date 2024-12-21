function setContainerHeight(height) {
    const bContainer = document.querySelector(".bContainer");
    bContainer.style.height = height + "px";
  }
  
  // Event listeners for buttons
  document.getElementById("signUp").addEventListener("click", function() {
    setContainerHeight(1080);
  });
  
  document.getElementById("signIn").addEventListener("click", function() {
    setContainerHeight(720);
  });
  