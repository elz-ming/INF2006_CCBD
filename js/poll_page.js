document.addEventListener("DOMContentLoaded", function () {
  const backButton = document.getElementById("back-button");
  const searchButton = document.getElementById("search-button");
  const searchInput = document.getElementById("search-input");

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

  // Add event listener to the search button
  searchButton.addEventListener("click", function () {
    const inputId = searchInput.value.trim();

    if (inputId) {
      let pollFound = false;

      pollRows.forEach(function (row) {
        const pollId = row.getAttribute("data-id");

        if (pollId === inputId) {
          pollFound = true;
          window.location.href = `views/voting_page.php?id=${pollId}`;
        }
      });

      if (!pollFound) {
        showPopup("No poll found with that ID."); // Show popup if no poll matches
      }
    } else {
      showPopup("Please enter a poll ID."); // Show popup for empty input
    }
  });

  // Function to show success/error popup
  function showPopup(message) {
    const popup = document.createElement("div");
    popup.className = "error-popup"; // Use the existing error popup class
    popup.textContent = message;

    document.body.appendChild(popup);

    setTimeout(() => {
      popup.remove();
    }, 3000); // Auto-hide after 3 seconds
  }
});
