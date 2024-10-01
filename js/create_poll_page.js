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

  document.getElementById('poll-form').addEventListener('submit', function(event) {
    const question1 = document.getElementById('question1').value.trim();
    const question2 = document.getElementById('question2').value.trim();
    const question3 = document.getElementById('question3').value.trim();
    const question4 = document.getElementById('question4').value.trim();

    let filledQuestions = 0;

    if (question1) filledQuestions++;
    if (question2) filledQuestions++;
    if (question3) filledQuestions++;
    if (question4) filledQuestions++;

    if (filledQuestions < 2) {
        alert('Please fill out at least two questions.');
        event.preventDefault();
    }
  });
});