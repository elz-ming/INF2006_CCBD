<?php
// session_start();
// require_once "./configs/dbconnection.php";


?> 
  
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Real time live voting | CCBD Group 5</title>
  <!-- Favicon -->
  <link rel="icon" href="../assets/img/brand/favicon.ico" type="image/x-icon">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="../assets/vendor/nucleo/csss/nucleo.css" type="text/css">
  <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../assets/css/argon.css?v=1.2.0" type="text/css">
  <!-- Sweet Alert -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.all.min.js"></script>
</head>

<body class="bg-default">
    <!-- Navbar -->
    <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="ui/results-dash.php">
	  	<h2 class="text-white">Cloud Computing & Big Data </h2>
		<h3 class="text-white">Group 5: Real time live voting system</h3>
        <img src="../assets/img/brand/white.png">

      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="ui/results-dash.php">
                <img src="../assets/img/brand/blue.png">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <ul class="navbar-nav ml-auto">
        <!-- <li class="nav-item">
            <a href="index.php" class="nav-link">
              <span class="nav-link-inner--text">Home</span>
            </a>
          </li> -->
          
          <li class="nav-item">
            <a href="ui/results-dash.php" class="nav-link">
              <span class="nav-link-inner--text">Results Dashboard</span>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="aboutus.php" class="nav-link">
              <span class="nav-link-inner--text">About Us</span>
            </a>
          </li> -->
        </ul>
      </div>
    </div>
  </nav>
         

    <!-- Header -->
    <!-- Header -->
    <!-- Main content -->
  <div class="main-content" >
    <!-- Header -->
    <div class="header bg-gradient-primary py-5 py-lg-5 pt-lg-7">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-white">Welcome!</h1>
              <p class="text-lead text-white">Choose your role</p>
              <div class="drop-down-box">
              <!-- <p> select your role </p> -->
                <!-- <label for="role" class="text-white">Choose your role </label> -->
                <select name="role" id="role" class="form-control" onchange="updatePageContent()">
                  <option value="admin">Admin</option>
                  <option value="voter">Voter</option>
                </select>
                <br><br>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0 mb-0">
            <!-- Voter content -->
            <div id="voter-content">
            <form method="POST" autocomplete="off" autofocus action="">
              <div class="text-center text-muted mb-4">
              <h3>Enter your Voting Credentials</h3>
              </div>
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i></span>
                    </div>
                    <input class="form-control form-control-md"  name="Poll ID" id="Poll ID" placeholder=" Poll ID" type="text"required>
                  </div>
                </div>
                <div class="text-center">
                  <button name="sign_in" type="submit" class="btn btn-primary my-4">Vote Now</button>
                </div>
            </form>
            </div>

            <!-- Admin Content -->
            <div id="admin-content" style="display: none;">
              <form method="POST" autocomplete="off" action="">
                <div class="text-center text-muted mb-4">
                  <h3>Admin Login</h3>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                    </div>
                    <input class="form-control form-control-md" name="userid" id="userid" placeholder="Admin ID" type="text" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                    </div>
                    <input class="form-control form-control-md" name="email" id="email" placeholder="Email" type="email" required>
                  </div>
                </div>
                <div class="text-center">
                  <button name="sign_in" type="submit" class="btn btn-primary my-4">Log In</button>
                </div>
              </form>
            </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>
  <!-- Footer -->
      <!-- Footer -->
      <footer class="footer-main pt-0">
      <!-- <div class="container">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6">
            <div class="copyright text-center  text-lg-left  text-muted">
              &copy; 2021 <a href="" class="font-weight-bold ml-1" target="_blank">Nyathira Kanga</a>
            </div>
          </div>
          <div class="col-lg-6">
            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
              
              
              <li class="nav-item">
                <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
              </li>
            </ul>
          </div>
        </div> -->
      </footer>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.2.0"></script>
  
  <!-- JavaScript to handle role change -->
  <script>
    function updatePageContent() {
      const role = document.getElementById("role").value;
      
      // Show voter content if voter is selected, admin content if admin is selected
      if (role === "voter") {
        document.getElementById("voter-content").style.display = "block";
        document.getElementById("admin-content").style.display = "none";
      } else if (role === "admin") {
        document.getElementById("admin-content").style.display = "block";
        document.getElementById("voter-content").style.display = "none";
      }
    }

    // Call this function on page load to ensure content is hidden initially
    window.onload = function() {
      updatePageContent();
    };
  </script>
</body>

</html>
 

<?php

require_once './assets/vendor/autoload.php';

$token = bin2hex(random_bytes(50)); // generate unique token
$token = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 6);
//$tokenhash = password_hash($token, PASSWORD_BCRYPT); 
//echo $tokenhash;
$smtp_host_ip = gethostbyname('smtp.office365.com');//'smtp.gmail.com');
// But for others only the smtp address 
$smtp_host_ip = 'smtp.office365.com';//'smtp.gmail.com';
 // Create the Transport
 $transport = (new Swift_SmtpTransport($smtp_host_ip, 587, 'ssl')) //465
     ->setUsername('2302934@sit.singaporetech.edu.sg')
     ->setPassword('K4730544k_2934');
 
   
 
 // Create the Mailer using your created Transport
 $mailer = new Swift_Mailer($transport);
  
     function sendVerificationEmail($email_entered,$token)
 {
     global $mailer;
     
 
     $body = '<!DOCTYPE html>
     <html lang="en">
 
     <head>
       <meta charset="UTF-8">
       <title>One Time Password</title>
       
     </head>
 
     <body>
       <div class="wrapper">
       <p> Hi '.$email_entered.',</p>
       <p><b> ------------- CONFIDENTIAL: DO NOT SHARE WITH ANYONE -------------------</b></p>
       <p> Take note of this One Time Password and use it to login to Secure Voting System and be a part of the election here.</p>
       <p><b> '.$token.'</b> </p>
      
       </div>
     </body>
 
     </html>';
 
     // Create a message
     $message = (new Swift_Message('Your One Time Password'))
         ->setFrom('2302934@sit.singaporetech.edu.sg')
         ->setTo($email_entered)
         ->setBody($body, 'text/html');
 
     // Send the message
     $result = $mailer->send($message);
 
     if ($result > 0) {
         return true;
     } else {
         return false;
     }
 }
 


if (isset($_POST["sign_in"]))
{    
    $userid_entered = mysqli_real_escape_string($conn, $_POST["userid"]);
    $phonenumber_entered = mysqli_real_escape_string($conn, $_POST["phonenumber"]);
    $email_entered = mysqli_real_escape_string($conn, $_POST["email"]);

 $sqlquery="SELECT * FROM users WHERE UserID = '$userid_entered' LIMIT 1";   

    $query_result = $conn->query($sqlquery);
   
    
 
   if ($query_result->num_rows > 0)
        {

                    $_SESSION["control"] = $query_result->fetch_assoc();

                    $phonenumber_stored = $_SESSION["control"]["PhoneNumber"];
                    $userid_stored = $_SESSION["control"]["UserID"];
                   $username_stored = $_SESSION["control"]["OtherNames"];
                   $email_stored = $_SESSION["control"]["Email"];
                   $status = $_SESSION["control"]["Status"];
                

                   $updatequery="UPDATE users SET Token ='$token' WHERE UserID  = '$userid_entered' LIMIT 1"; 
                   $query_result = $conn->query($updatequery);
                   
            if ($phonenumber_entered == $phonenumber_stored && $userid_entered == $userid_stored && $email_entered == $email_stored )
                    {
         if ($status==NULL ){
                sendVerificationEmail($email_entered,$token);
                        echo '
                        <script type="text/javascript">
                        
                        $(document).ready(function(){
                          swal({
                            title: "Hi!" ,
                            text: "We just sent a code to you, dont forget to check your spam",
                            type: "success"
                        }).then(function() {
                            window.location = "verify-user.php ";
                        });
                        
                        
                        });
                        
                        </script>
                        ';  
                        
                     
                        exit();
                     
                    }
                    
                 
                  else{
                        echo '
                        <script type="text/javascript">
                        
                        $(document).ready(function(){
                          swal({
                            title: "Error!",
                            text: "We cannot log you in again, you already voted",
                            
                            type: "error"
                        }).then(function() {
                            window.location = "index.php";
                        });
                        
                        
                        });
                        
                        </script>
                        ';  
                        exit();
                    }
       } 
        }
         
          else
        {
             echo '
            <script type="text/javascript">
            
            $(document).ready(function(){
              swal({
                title: "Error!",
                text: "Please enter valid details",
                type: "error"
            }).then(function() {
                window.location = "index.php";
            });
            });
            </script>
            '; 
            exit(); 
        }
        }
?>
  