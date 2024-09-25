// JavaScript function to fetch data using AJAX
document.getElementById("fetchButton").addEventListener("click", fetchData);

function fetchData() {
  fetch("api/fetch-data.php")
    .then((response) => response.json())
    .then((data) => {
      // Display the fetched data
      let output = "<h3>Fetched Data:</h3>";
      data.forEach((row) => {
        output += `<p>ID: ${row.id}, Name: ${row.name}</p>`;
      });
      document.getElementById("result").innerHTML = output;
    })
    .catch((error) => {
      console.error("Error fetching data:", error);
      document.getElementById(
        "result"
      ).innerHTML = `<p style="color: red;">Failed to fetch data. Please try again.</p>`;
    });
}
