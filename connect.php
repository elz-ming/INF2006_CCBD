<?php
// Load environment variables if using .env (ensure the .env file is properly set up

function loadEnv($path)
{
  if (!file_exists($path)) {
    throw new Exception("The .env file does not exist.");
  }

  $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

  foreach ($lines as $line) {
    if (strpos(trim($line), '#') === 0) {
      continue;
    }
    list($key, $value) = explode('=', $line, 2);
    $value = trim($value, "\"'");
    putenv(sprintf('%s=%s', trim($key), $value));
    $_ENV[trim($key)] = $value;
    $_SERVER[trim($key)] = $value;
  }
}

// Load .env file (optional if you're using environment variables)
loadEnv(__DIR__ . '/.env');

// Retrieve environment variables
$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$dbname = getenv('DB_NAME');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');

try {
  // Create a new PDO instance for PostgreSQL connection
  $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
  $pdo = new PDO($dsn, $user, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  // Enable exceptions on errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC  // Fetch data as associative arrays
  ]);

} catch (PDOException $e) {
  // Handle connection errors
  die("Database connection failed: " . $e->getMessage());
}
?>