<?php
require 'connect.php';
?>

<!-- test push -->
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Rachel Square</title>
  <link rel="stylesheet" href="/css/styles.css" />
  <link rel="stylesheet" href="/css/index.css" />
  <script src="/js/index.js" defer></script>
</head>

<body>
  <?php
  include('components/background.php')
    ?>
  <?php
  include('components/header.php');
  ?>
  <main>
    <h2>Click the button to fetch test data</h2>
    <button id="fetchButton">Fetch Data</button>
    <div id="result"></div>
  </main>
  <?php
  include('components/footer.php');
  ?>
</body>

</html>