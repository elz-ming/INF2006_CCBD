<?php require '../connect.php'; 

try {
    $poll_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting Page</title>
    <link rel="stylesheet" href="/css/styles.css" />
</head>
<body style = " display: flex; flex-direction: column;">
    <?php include '../components/background.php'; ?>
    <?php include '../components/header.php'; ?>
    <!-- <div > -->
        <div class="top-left"><?php include '../components/backbutton.php';?> </div>
        <div class="question"><?=htmlspecialchars($poll['question'])?></div>
    <!-- </div> -->
    <div className='answer-container'>
        <div className='q1'>
            <button class="answer"><?=htmlspecialchars($poll['selection1'])?></button>
        </div> 
        <div className='q2' >
            <button class="answer"><?=htmlspecialchars($poll['selection2'])?></button>
        </div> 
        <div className='q3' >
            <button class="answer"><?=htmlspecialchars($poll['selection3'])?></button>
        </div> 
        <div className='q4'>
            <button class="answer"><?=htmlspecialchars($poll['selection4'])?></button>
        </div> 
    </div>
</body>
</html>

<?php include '../components/footer.php'; ?>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.answer');
            buttons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const answer = this.getAttribute('data-answer');
                    window.location.href = `result_page.php?answer=${encodeURIComponent(answer)}`;
                });
            });
        });
    </script>