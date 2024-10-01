<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Poll</title>
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="../css/create_poll_page.css">
</head>
<body>
<?php include '../components/header.php'; ?>
<?php include '../components/background.php'; ?>
  <div class="container">
    <h2>Create a New Poll</h2>
    <form action="../api/create_poll.php" method="post">
      <div class="form-group">
        <label for="title" class="label-bold">Poll Title:</label>
        <input type="text" id="title" name="title" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="question1">Question 1:</label>
        <input type="text" id="question1" name="answer1" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="question2">Question 2:</label>
        <input type="text" id="question2" name="answer2" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="question3">Question 3:</label>
        <input type="text" id="question3" name="answer3" class="form-control">
      </div>
      <div class="form-group">
        <label for="question4">Question 4:</label>
        <input type="text" id="question4" name="answer4" class="form-control">
      </div>
      <button type="submit" class="btn btn-primary">Create Poll</button>
    </form>
  </div>
  <script src="../js/create_poll_page.js"></script>
<?php include '../components/footer.php'; ?>
</body>
</html>