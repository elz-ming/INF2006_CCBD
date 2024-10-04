<?php require '../connect.php';

try {
  $poll_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

  $query = 'SELECT question, selection1, selection2, selection3, selection4 FROM polls WHERE id = :poll_id';
  $stmt = $pdo->prepare($query);
  $stmt->execute(['poll_id' => $poll_id]);
  $poll = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  // Handle any errors
  echo "Failed to fetch poll data: " . $e->getMessage();
  $poll = null; // Set poll to null if there is an error
}
?>

<!DOCTYPE html>
<html lang="en">
<!-- test -->

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Voting Page</title>
  <link rel="stylesheet" href="/css/styles.css" />
  <link rel="stylesheet" href="/css/voting_page.css" />
</head>

<body>
  <?php include '../components/background.php'; ?>
  <?php include '../components/header.php'; ?>
  <main>
    <section id="question">
      <h2><?= htmlspecialchars($poll['question']) ?></h2>
    </section>
    <section id="answers">
      <button id="answer-1" class="answer"
        data-answer="selection1"><?= htmlspecialchars($poll['selection1']) ?></button>
      <button id="answer-2" class="answer"
        data-answer="selection2"><?= htmlspecialchars($poll['selection2']) ?></button>
      <button id="answer-3" class="answer"
        data-answer="selection3"><?= htmlspecialchars($poll['selection3']) ?></button>
      <button id="answer-4" class="answer"
        data-answer="selection4"><?= htmlspecialchars($poll['selection4']) ?></button>
    </section>
  </main>
  <?php include '../components/footer.php'; ?>

  <script>
    var pollId = <?= json_encode($poll_id) ?>;
  </script>
  <script src="../js/voting_page.js"></script>
</body>

</html>