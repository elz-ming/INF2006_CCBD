<?php require 'connect.php'; // Make sure connect.php is correctly set up for your database connection

// Fetch poll data from the database
try {
  // Example query to fetch polls from the database
  $query = 'SELECT id, created_at, question FROM polls ORDER BY created_at DESC';
  $stmt = $pdo->query($query);
  $polls = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  // Handle any errors
  echo "Failed to fetch poll data: " . $e->getMessage();
  $polls = []; // Set polls to an empty array if there is an error
}
?>

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
    <section id="search-bar">
      #<input id="search-input" type="text" placeholder="00000000" maxlength="8" />
      <button id="search-button"><svg width="40" height="33" viewBox="0 0 40 33" fill="none"
          xmlns="http://www.w3.org/2000/svg">
          <g clip-path="url(#clip0_1_87)">
            <path
              d="M32.6667 31.7L22.1667 21.2C21.3333 21.8666 20.375 22.3944 19.2917 22.7833C18.2083 23.1722 17.0556 23.3666 15.8333 23.3666C12.8056 23.3666 10.2433 22.3177 8.14667 20.22C6.05 18.1222 5.00111 15.56 5 12.5333C4.99889 9.50662 6.04778 6.9444 8.14667 4.84662C10.2456 2.74884 12.8078 1.69995 15.8333 1.69995C18.8589 1.69995 21.4217 2.74884 23.5217 4.84662C25.6217 6.9444 26.67 9.50662 26.6667 12.5333C26.6667 13.7555 26.4722 14.9083 26.0833 15.9916C25.6944 17.075 25.1667 18.0333 24.5 18.8666L35 29.3666L32.6667 31.7ZM15.8333 20.0333C17.9167 20.0333 19.6878 19.3044 21.1467 17.8466C22.6056 16.3888 23.3344 14.6177 23.3333 12.5333C23.3322 10.4488 22.6033 8.67828 21.1467 7.22162C19.69 5.76495 17.9189 5.03551 15.8333 5.03328C13.7478 5.03106 11.9772 5.76051 10.5217 7.22162C9.06611 8.68273 8.33667 10.4533 8.33333 12.5333C8.33 14.6133 9.05945 16.3844 10.5217 17.8466C11.9839 19.3088 13.7544 20.0377 15.8333 20.0333Z"
              fill="#FFBC42" />
          </g>
          <defs>
            <clipPath id="clip0_1_87">
              <rect width="40" height="32" fill="white" transform="translate(0 0.699951)" />
            </clipPath>
          </defs>
        </svg>
      </button>
    </section>
    <section id="poll-display">
      <?php if (!empty($polls)): ?>
        <?php foreach ($polls as $poll): ?>
          <div class="poll-row" id="" data-id="<?= htmlspecialchars($poll['id']) ?>">
            <div class="poll-title">
              <div class="poll-id">#<?= htmlspecialchars($poll['id']) ?></div>
              <div class="poll-date">created at <?= htmlspecialchars(date('Y-m-d', strtotime($poll['created_at']))) ?>
              </div>
            </div>
            <div class="poll-question"><?= htmlspecialchars($poll['question']) ?>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>No polls available.</p>
      <?php endif; ?>
    </section>
  </main>
  <?php
  include('components/footer.php');
  ?>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const pollRows = document.querySelectorAll('.poll-row');
      pollRows.forEach(function (row) {
        row.addEventListener('click', function (event) {
          event.preventDefault();
          const pollId = this.getAttribute('data-id');
          window.location.href = `views/voting_page.php?id=${pollId}`;
        });
      });
    });
  </script>
</body>

</html>