document.addEventListener("DOMContentLoaded", function () {
  const backButton = document.getElementById("back-button");

  if (backButton) {
    backButton.addEventListener("click", () => {
      window.location.href = "/"; // Adjust the path to your homepage if needed
    });
  }

  const buttons = document.querySelectorAll(".answer");
  buttons.forEach(function (button) {
    button.addEventListener("click", function () {
      const answer = this.getAttribute("data-answer");
      // Send the selection to the submit_vote.php using fetch
      fetch("/api/submit_vote.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          poll_id: pollId,
          selection: answer,
        }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            window.location.href = `result_page.php?poll_id=${pollId}`;
          } else {
            alert("Failed to submit vote. " + data.error);
          }
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    });
  });
});
