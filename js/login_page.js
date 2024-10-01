document.addEventListener("DOMContentLoaded", function () {
  const backButton = document.getElementById("back-button");
  const loginButton = document.getElementById("login-button");

  if (backButton) {
    backButton.addEventListener("click", () => {
      window.location.href = "/"; // Adjust the path to your homepage if needed
    });
  }

  if (loginButton) {
    loginButton.style.display = "none";
  }

  const toggle = document.querySelector(".toggle"),
  input = document.querySelector(".password");
  toggle.addEventListener("click", () => {
  if (input.type === "password") {
      input.type = "text";
      toggle.classList.replace("fa-eye", "fa-eye-slash");
  } else {
      input.type = "password";
      toggle.classList.replace("fa-eye-slash", "fa-eye");
  }
  });
  
  const loginForm = document.getElementById("login-form");
  const registerForm = document.getElementById("register-form");
  const showRegisterLink = document.getElementById("show-register");
  const showLoginLink = document.getElementById("show-login");

  if (showRegisterLink) {
    showRegisterLink.addEventListener("click", (event) => {
      event.preventDefault();
      loginForm.classList.add("hidden");
      registerForm.classList.remove("hidden");
    });
  }

  if (showLoginLink) {
    showLoginLink.addEventListener("click", (event) => {
      event.preventDefault();
      registerForm.classList.add("hidden");
      loginForm.classList.remove("hidden");
    });
  }
});