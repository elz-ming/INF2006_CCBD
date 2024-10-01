document.addEventListener("DOMContentLoaded", function () {
  const backButton = document.getElementById("back-button");

  if (backButton) {
    backButton.style.display = "none";
  }

  const pollRows = document.querySelectorAll(".poll-row");
  pollRows.forEach(function (row) {
    row.addEventListener("click", function (event) {
      event.preventDefault();
      const pollId = this.getAttribute("data-id");
      window.location.href = `views/voting_page.php?id=${pollId}`;
    });
  });
});
