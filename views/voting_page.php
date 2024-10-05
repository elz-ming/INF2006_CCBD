<?php require '../connect.php';

$app_key = '5APX793hEJgDmzmB2xCcKI9ybgvYuyFTE8xzj2H7';

function getFunFact($question) {
  $url = 'https://api.cohere.com/v1/chat';

  $data = array(
      'model' => 'command-r-08-2024', 
      "message"=>  "Can you give me a 1-sentence fun fact of the question: " . $question,
      "preamble"=>  "You are an AI-assistant chatbot. You are trained to assist users by providing thorough and helpful responses to their queries."
  );

  // Setup cURL
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Authorization: Bearer ' . $GLOBALS['app_key'],
      'Content-Type: application/json',
  ));

  $response = curl_exec($ch);

  if (curl_errno($ch)) {
    echo 'cURL error: ' . curl_error($ch);
  }

  curl_close($ch);
  $result = json_decode($response, true);

  if (isset($result['text'])) {
    return trim($result['text']);
  } else {
      return "No fun fact available.";
  }
}


try {
  $poll_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

  $query = 'SELECT question, selection1, selection2, selection3, selection4 FROM polls WHERE id = :poll_id';
  $stmt = $pdo->prepare($query);
  $stmt->execute(['poll_id' => $poll_id]);
  $poll = $stmt->fetch(PDO::FETCH_ASSOC);

  // Get a fun fact for the poll question
  $fun_fact = getFunFact($poll['question']);

} catch (PDOException $e) {
  // Handle any errors
  echo "Failed to fetch poll data: " . $e->getMessage();
  $poll = null; // Set poll to null if there is an error
  $fun_fact = "Unable to generate fun fact.";
}
?>

<!DOCTYPE html>
<html lang="en">

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
    <section id="funfact">
      <p><strong>Fun Fact:</strong> <?= htmlspecialchars($fun_fact) ?></p>
    </section>
    <section id="answers">
    <?php if (!is_null($poll['selection1'])): ?>
    <button id="answer-1" class="answer" data-answer="selection1">
        <?= htmlspecialchars($poll['selection1']) ?>
    </button>
<?php endif; ?>

<?php if (!is_null($poll['selection2'])): ?>
    <button id="answer-2" class="answer" data-answer="selection2">
        <?= htmlspecialchars($poll['selection2']) ?>
    </button>
<?php endif; ?>

<?php if (!is_null($poll['selection3'])): ?>
    <button id="answer-3" class="answer" data-answer="selection3">
        <?= htmlspecialchars($poll['selection3']) ?>
    </button>
<?php endif; ?>

<?php if (!is_null($poll['selection4'])): ?>
    <button id="answer-4" class="answer" data-answer="selection4">
        <?= htmlspecialchars($poll['selection4']) ?>
    </button>
<?php endif; ?>
    </section>
  </main>
  <?php include '../components/footer.php'; ?>

  <script>
    var pollId = <?= json_encode($poll_id) ?>;
  </script>
  <script src="../js/voting_page.js"></script>
</body>

</html>