document.addEventListener("DOMContentLoaded", function () {
  const backButton = document.getElementById("back-button");

  if (backButton) {
    backButton.addEventListener("click", () => {
      window.location.href = "/"; // Adjust the path to your homepage if needed
    });
  }
});
