document.addEventListener("DOMContentLoaded", function () {
  const buttons = document.querySelectorAll(".answer");
  buttons.forEach(function (button) {
    button.addEventListener("click", function () {
      const answer = this.getAttribute("data-answer");
      window.location.href = `result_page.php?answer=${encodeURIComponent(
        answer
      )}`;
    });
  });
});
