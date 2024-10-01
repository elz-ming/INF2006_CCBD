<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="../css/login_page.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
<?php include '../components/background.php'; ?>
<?php include "../components/header.php"; ?>
  <div class="container">
    <div class="form-box box">
      <?php include "../connect.php";
      if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $sql = "select * from users where email='$email'";
        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) > 0) {
          $row = mysqli_fetch_assoc($res);
          $password = $row['password'];
          $decrypt = password_verify($pass, $password);

          if ($decrypt) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("location: home.php");
          } else {
            echo "<div class='message'>
                    <p>Wrong Password</p>
                    </div><br>";
            echo "<a href='login.php'><button class='btn'>Go Back</button></a>";
          }
        } else {
          echo "<div class='message'>
                    <p>Wrong Email or Password</p>
                    </div><br>";
          echo "<a href='login.php'><button class='btn'>Go Back</button></a>";
        }
      } else {
        ?>
  <div class="login-container">
        <!-- Login Form -->
        <form id="login-form" action="../api/login.php" method="post">
            <h2>Login</h2>
            <hr>
            <div class="form-box">
                <div class="input-container">
                    <i class="fa fa-envelope fa-5x icon"></i>
                    <input class="input-field" type="email" placeholder="Email Address" name="email">
                </div>
                <div class="input-container">
                    <i class="fa fa-lock fa-5x icon"></i>
                    <input class="input-field password" type="password" placeholder="Password" name="password">
                    <i class="fa fa-eye toggle fa-5x icon"></i>
                </div>
                <div class="remember">
                    <input type="checkbox" class="check" name="remember_me">
                    <label for="remember">Remember me</label>
                    <!-- <span><a href="forgot.php">Forgot password</a></span> excluded forget me cause it probably will take too long-->
                </div>
            </div>
            <input type="submit" name="login" id="submit" value="Login" class="button">
            <div class="links">
                Don't have an account? <a href="#" id="show-register">Signup Now</a>
            </div>
        </form>

        <!-- Registration Form -->
        <form id="register-form" action="../api/register.php" method="post" class="hidden">
            <h2>Register</h2>
            <hr>
            <div class="form-box">
                <div class="input-container">
                    <i class="fa fa-user fa-5x icon"></i>
                    <input class="input-field" type="text" placeholder="Username" name="username">
                </div>
                <div class="input-container">
                    <i class="fa fa-envelope fa-5x icon"></i>
                    <input class="input-field" type="email" placeholder="Email Address" name="email">
                </div>
                <div class="input-container">
                    <i class="fa fa-lock fa-5x icon"></i>
                    <input class="input-field password" type="password" placeholder="Password" name="password">
                    <i class="fa fa-eye toggle fa-5x icon"></i>
                </div>
            </div>
            <input type="submit" name="register" id="register-submit" value="Register" class="button">
            <div class="links">
                Already have an account? <a href="#" id="show-login">Login Now</a>
            </div>
        </form>
    </div>
      <?php } ?>
  </div>
    <script src= "../js/login_page.js"></script>
    <?php include('../components/footer.php');?>
</body>
</html>