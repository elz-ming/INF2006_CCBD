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

  document
    .getElementById("poll-form")
    .addEventListener("submit", function (event) {
      event.preventDefault(); // Prevent the default form submission

      const question1 = document.getElementById("question1").value.trim();
      const question2 = document.getElementById("question2").value.trim();
      const question3 = document.getElementById("question3").value.trim();
      const question4 = document.getElementById("question4").value.trim();

      let filledQuestions = 0;

      if (question1) filledQuestions++;
      if (question2) filledQuestions++;
      if (question3) filledQuestions++;
      if (question4) filledQuestions++;

      if (filledQuestions < 2) {
        alert("Please fill out at least two questions.");
        return;
      }

      // Create a FormData object to send the form data
      const formData = new FormData(this);

      // Send the form data using fetch API
      fetch("../api/create_poll.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            window.location.reload(); // Reload the page
          } else {
            showPopup(data.error);
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          showPopup("An error occurred. Please try again.");
        });

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
    });
});
