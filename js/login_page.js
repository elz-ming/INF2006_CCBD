document.addEventListener("DOMContentLoaded", function () {
  const backButton = document.getElementById("back-button");

  if (backButton) {
    backButton.addEventListener("click", () => {
      window.location.href = "/"; // Adjust the path to your homepage if needed
    });
  }

  const loginForm = document.getElementById("login-form");
  const registerForm = document.getElementById("register-form");

  // Handle login form submission
  if (loginForm) {
    loginForm.addEventListener("submit", function (event) {
      event.preventDefault(); // Prevent the default form submission

      const formData = new FormData(loginForm);

      // Send login data via fetch
      fetch("../api/login.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            // Redirect to the specified page on success
            window.location.href = `create_poll_page.php`;
          } else {
            // Show error popup
            showPopup(data.error);
          }
        })
        .catch((error) => showPopup("An error occurred. Please try again."));
    });
  }

  // Handle register form submission
  if (registerForm) {
    registerForm.addEventListener("submit", function (event) {
      event.preventDefault(); // Prevent the default form submission

      const formData = new FormData(registerForm);

      // Send registration data via fetch
      fetch("../api/register.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            // Redirect to the login page on successful registration
            window.location.href = `create_poll_page.php`;
          } else {
            // Show error popup
            showPopup(data.error);
          }
        })
        .catch((error) => showPopup("An error occurred. Please try again."));
    });
  }

  // Function to show error popup
  function showPopup(message) {
    const popup = document.createElement("div");
    popup.className = "error-popup";
    popup.textContent = message;

    document.body.appendChild(popup);

    setTimeout(() => {
      popup.remove();
    }, 3000); // Auto-hide after 3 seconds
  }

  // Toggle show/hide password functionality
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

  // Toggle between login and register forms
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
