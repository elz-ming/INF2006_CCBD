<?php

// require_once "./configs/dbconnection.php";

//number of total votes casted
$numbertotalvotescasted="SELECT COUNT(*) as totalvotescasted FROM users WHERE Status='Voted'";
$view =$conn->query($numbertotalvotescasted); 
$totalvotescast=mysqli_fetch_assoc($view);
$totalvotes= $totalvotescast['totalvotescasted'];

//number of total voters
$numbertotalvoters="SELECT COUNT(*) as totalvoters FROM users WHERE (UserType='Voter') OR (UserType='Candidate');";
$viewvoters =$conn->query($numbertotalvoters); 
$totalvoters=mysqli_fetch_assoc($viewvoters);
$allvoters= $totalvoters['totalvoters'];

// % of votes casted
$votescastedpercent=$totalvotes/$allvoters*100;
//echo  round($votescastedpercent, 2);

//total votes in each post
$totalpresvotes ="SELECT TotalVotesByPost as totalpresident FROM totalvotes";
$totalpres =$conn->query($totalpresvotes); 
$totalpresident=mysqli_fetch_assoc($totalpres);
$prestotal= $totalpresident['totalpresident'];
//echo $prestotal;

$totalgovvotes ="SELECT TotalVotesByPost as totalgov FROM totalvotes";
$totalgov =$conn->query($totalgovvotes); 
$totalgovernor=mysqli_fetch_assoc($totalgov);
$govtotal= $totalgovernor['totalgov'];
//echo $govtotal;

$totalmpvotes="SELECT TotalVotesByPost as totalmp FROM totalvotes";
$totalmp =$conn->query($totalmpvotes); 
$totalmp=mysqli_fetch_assoc($totalmp);
$mptotal= $totalmp['totalmp'];
//echo $mptotal;

$totalypvotes ="SELECT TotalVotesByPost as totalyp FROM totalvotes";
$totalyp =$conn->query($totalypvotes); 
$totalyp=mysqli_fetch_assoc($totalyp);
$yptotal= $totalyp['totalyp'];
//echo $yptotal;

//finding top candidate in each post using votes
$toppres="SELECT UserID,MAX(votes) as highestpres FROM `totalvotes` WHERE ElectionType='President'";
$viewtoppres =$conn->query($toppres); 
$toppresvoted=mysqli_fetch_assoc($viewtoppres);
$pres= $toppresvoted['highestpres'];
$presID= $toppresvoted['UserID'];
//echo $presID;

$topgov="SELECT UserID,MAX(votes) as highestgov FROM `totalvotes` WHERE ElectionType='Governor'";
$viewtopgov =$conn->query($topgov); 
$topgovvoted=mysqli_fetch_assoc($viewtopgov);
$gov= $topgovvoted['highestgov'];
$govID= $topgovvoted['UserID'];
//echo $gov;

$topmp="SELECT UserID,MAX(votes) as highestmp FROM `totalvotes` WHERE ElectionType='Member of Parliament'";
$viewtopmp =$conn->query($topmp); 
$topmpvoted=mysqli_fetch_assoc($viewtopmp);
$mp= $topmpvoted['highestmp'];
$mpID= $topmpvoted['UserID'];
//echo $mp;

$topyp ="SELECT UserID,MAX(votes) as highestyp FROM `totalvotes` WHERE ElectionType='Youth Representative'";
$viewtopyp  =$conn->query($topyp ); 
$topypvoted=mysqli_fetch_assoc($viewtopyp );
$yp= $topypvoted['highestyp'];
$ypID= $topypvoted['UserID'];
//echo $yp;


//% of votes for highest candidate
//% of pres votes
$prespercent=$pres/$prestotal*100;
//echo  round($prespercent, 2);

//% of gov votes
$govpercent=$gov/$govtotal*100;

//% of mp votes
$mppercent=$mp/$mptotal*100;


//% of pres votes
$yppercent=$yp/$yptotal*100;

//finding top candidate name per post
$presname="SELECT OtherNames,Surname FROM `users` WHERE UserID='$presID'";
$viewpname  =$conn->query($presname); 
$topp=mysqli_fetch_assoc($viewpname );
$pname= $topp['OtherNames']."  ".$topp['Surname'];

$gnames="SELECT OtherNames,Surname FROM `users`WHERE UserID='$govID'";
$viewgname  =$conn->query($gnames); 
$topg=mysqli_fetch_assoc($viewgname );
$gname= $topg['OtherNames']."  ".$topg['Surname'];

$mpnames="SELECT OtherNames,Surname FROM `users`WHERE UserID='$mpID'";
$viewmpname  =$conn->query($mpnames); 
$topmp=mysqli_fetch_assoc($viewmpname );
$mpname= $topmp['OtherNames']."  ".$topmp['Surname'];

$ypnames="SELECT OtherNames,Surname FROM `users`WHERE UserID='$ypID'";
$viewypname  =$conn->query($ypnames); 
$topyp=mysqli_fetch_assoc($viewypname );
$ypname= $topyp['OtherNames']."  ".$topyp['Surname'];


?>

<!DOCTYPE html>
<html>
<style>
html, body {
  max-width: 100%;
  overflow-x: hidden;
};


  </style>
<head>
  <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="refresh" content="30">

  <title>Secure Vote | Results Dashboard</title>
  <!-- Favicon -->
  <link rel="icon" href="../assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="../assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../assets/css/argon.css?v=1.2.0" type="text/css">
  <!-- For charting -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript" >
     $('.carousel').carousel({
  interval: 2000
});

window.onresize = function(){ location.reload(); }
  </script>
 

  <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Surname', 'votes'],
         <?php
         $sql = "SELECT users.Surname,users.OtherNames,totalvotes.votes, totalvotes.ElectionType FROM totalvotes INNER JOIN users ON totalvotes.UserID=users.UserID WHERE totalvotes.ElectionType='President';";
         $fire = mysqli_query($conn,$sql);
          while ($result = mysqli_fetch_assoc($fire)) {
            echo"['".$result['Surname']."',".$result['votes']."],";
          }

         ?>
        ]);
     
        var options = {
        title: 'Presidential Results',
        fontSize:18,
          //is3D: true,
          is3D: true,
        };
        var chart = new google.visualization.PieChart(document.getElementById('president'));

        chart.draw(data,options);
      }
    </script>

<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Surname', 'votes'],
         <?php
         $sql = "SELECT users.Surname,users.OtherNames,totalvotes.votes, totalvotes.ElectionType FROM totalvotes INNER JOIN users ON totalvotes.UserID=users.UserID WHERE totalvotes.ElectionType='Governor';";
         $fire = mysqli_query($conn,$sql);
          while ($result = mysqli_fetch_assoc($fire)) {
            echo"['".$result['Surname']."',".$result['votes']."],";
          }

         ?>
        ]);

        var options = {
          title: 'Gubernatorial Election',
            fontSize:18,

          is3D: true,
        // height: 400,
        // width:900,
  

        };
        var chart = new google.visualization.PieChart(document.getElementById('governor'));

        chart.draw(data,options);
      }
    </script>

<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Surname', 'votes'],
         <?php
         $sql = "SELECT users.Surname,users.OtherNames,totalvotes.votes, totalvotes.ElectionType FROM totalvotes INNER JOIN users ON totalvotes.UserID=users.UserID WHERE totalvotes.ElectionType='Member of Parliament';";

         $fire = mysqli_query($conn,$sql);
          while ($result = mysqli_fetch_assoc($fire)) {
            echo"['".$result['Surname']."',".$result['votes']."],";
          }

         ?>
        ]);

        var options = {
          title: 'Member of Parliament Election',
            fontSize:18,
         is3D: true,
        // height: 400,
        //  width:900,
  
        };
        var chart = new google.visualization.PieChart(document.getElementById('mp'));

        chart.draw(data,options);
      }
    </script>

<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Surname', 'votes'],
         <?php
         $sql = "SELECT users.Surname,users.OtherNames,totalvotes.votes, totalvotes.ElectionType FROM totalvotes INNER JOIN users ON totalvotes.UserID=users.UserID WHERE totalvotes.ElectionType='Youth Representative';";
         $fire = mysqli_query($conn,$sql);
          while ($result = mysqli_fetch_assoc($fire)) {
            echo"['".$result['Surname']."',".$result['votes']."],";
          }

         ?>
        ]);
        var options = {
         title: 'Youth Representative Election',
           fontSize:18,
         is3D: true,
        // height: 400,
        //  width:900,
  
       
        };
    
        var chart = new google.visualization.PieChart(document.getElementById('yp'));

        chart.draw(data,options);
      }
    </script>
</head>

<body class="">
 
    
  <!-- Sidenav -->
  
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <!-- Navbar -->
    <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
      <div class="container">
        <a class="navbar-brand" href="results-dash.php">
          <img src="../assets/img/brand/white.png">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
          <div class="navbar-collapse-header">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="results-dash.php">
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
          <li class="nav-item">
              <a href="index.php" class="nav-link">
                <span class="nav-link-inner--text">Home</span>
              </a>
            </li>
            
            <li class="nav-item">
              <a href="results-dash.php" class="nav-link">
                <span class="nav-link-inner--text">Results Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="aboutus.php" class="nav-link">
                <span class="nav-link-inner--text">About Us</span>
              </a>
            </li>
        
  
          </ul>
          <hr class="d-lg-none" />
          <ul class="navbar-nav align-items-lg-center ml-lg-auto">
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="https://facebook.com/chris.kay.754703" target="_blank" data-toggle="tooltip" data-original-title="Be my friend on Facebook">
                <i class="fab fa-facebook-square"></i>
                <span class="nav-link-inner--text d-lg-none">Facebook</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="https://www.instagram.com/christinenyathira" target="_blank" data-toggle="tooltip" data-original-title="Follow me on Instagram">
                <i class="fab fa-instagram"></i>
                <span class="nav-link-inner--text d-lg-none">Instagram</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="https://twitter.com/nyathiraa" target="_blank" data-toggle="tooltip" data-original-title="Follow me on Twitter">
                <i class="fab fa-twitter-square"></i>
                <span class="nav-link-inner--text d-lg-none">Twitter</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="https://github.com/nyathirak" target="_blank" data-toggle="tooltip" data-original-title="Star me on Github">
                <i class="fab fa-github"></i>
                <span class="nav-link-inner--text d-lg-none">Github</span>
              </a>
            </li>
            
          </ul>
        </div>
      </div>
    
           
    </nav>
    <!-- Header -->
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-6">
            <div class="col-lg-6 col-7">
              
            </div>
          
          </div>
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-3 col-md-5">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Voters</h5>
                      <!-- NUMBER OF TOTAL VOTES CASTED -->
                      <span class="h2 font-weight-bold mb-2 text-lowercase"> <?php  echo $totalvotescast['totalvotescasted']; ?> Votes Casted</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                        <i class="ni ni-active-40"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2 text-lowercase"> <?php echo  round($votescastedpercent, 2);?> % </span>
                    <span class="text-nowrap text-lowercase" >OF VOTES SUBMITTED</span>
                  </p>
                </div>
              </div>
            </div>
            
            <div class="col-xl-2 col-md-4">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Top President</h5>
                      <span class="h2 font-weight-bold mb-0"></span>
                    </div>
                    <div class="col-auto">
                      
                    </div>
                  </div>
                  
<p class="mt-3 mb-0 text-dark text-sm">
  <span class="text-nowrap"><?php echo $pname ?></span>
                  </p>
                  <p class="mt-3 mb-0  text-sm text-dark">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> Top by <?php echo  round($prespercent, 2); ?> % </span>
</p>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-md-4">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Top Governor</h5>
                      <span class="h2 font-weight-bold mb-0"></span>
                    </div>
                    <div class="col-auto">
                      
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-dark text-sm">
  <span class="text-nowrap"><?php echo $gname ?></span>
                  </p>

                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2 "><i class="fa fa-arrow-up"></i> Top by <?php echo  round($govpercent, 2); ?> % </span>
                   
                  </p>
                  
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-md-4">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Top MP</h5>
                      <span class="h2 font-weight-bold mb-0"></span>
                    </div>
                    <div class="col-auto">
                      
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-dark text-sm">
  <span class="text-nowrap"><?php echo $mpname ?></span>
                  </p> 

                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2 "><i class="fa fa-arrow-up"></i> Top by <?php echo  round($mppercent, 2); ?> % </span>
                   
                  </p>
                  
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-md-4">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Top Youth Rep</h5>
                      <span class="h2 font-weight-bold mb-0"></span>
                    </div>
                    <div class="col-auto">
                      
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-dark text-sm">
  <span class="text-nowrap"><?php echo $ypname ?></span>
                  </p>

                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2 "><i class="fa fa-arrow-up"></i> Top by <?php echo  round($yppercent, 2); ?> % </span>
                   
                  </p>
                 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Charts
  
  SELECT users.Surname,users.OtherNames,totalvotes.votes, totalvotes.ElectionType FROM totalvotes INNER JOIN users ON totalvotes.UserID=users.UserID ORDER BY ElectionType, votes DESC;-->
    
    <div class="container-fluid mt--5">
      <div class="row">
        <div class="col-xl-12">
       
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
               <div class="col">
                 
                 <h5 class="h2 mb-0">Visualize Election Results</h5>
                   <div class="col text-right">
       
                </div>   
                </div>

              </div>
            </div>
            <div class="card-body bg-transparent">
    <div style="height: 450px;" class="ml-0 py-0" id="president"></div>
    <div style="height: 450px;" class="ml-0 py-0" id="governor"></div>
    <div style="height: 450px;" class="ml-0 py-0" id="mp"></div>
    <div style="height: 450px;" class="ml-0 py-0" id="yp"></div>
    
              
               
           
             <!--
               <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner  " style="height: 450px;">
    <div class="carousel-item active">
   
              <div style="height: 450px;" class="ml-0 pt-0" id="president"></div>
           
             
             <div class="carousel-caption d-none d-md-block">
    <h2>Presidential Election</h2>
    
  
     </div>
    </div>
    
    <div class="carousel-item">
    <div  class="ml-0 pt-0 d-block w-100" id="governor"></div>
             
             <div class="carousel-caption d-none d-md-block">
    <h2>Gubernatorial Election</h2>
    

     </div>
    </div>
   
    <div class="carousel-item">
    
              <div class="ml-0 pt-0 d-block w-100" id="mp"></div>
             
             <div class="carousel-caption d-none d-md-block">
    <h2>Member of Parliament Election</h2>
    

   </div>

    </div>
    <div class="carousel-item">
  
              <div  class="ml-0 pt-0 d-block w-100" id="yp"></div>
         
             <div class="carousel-caption d-none d-md-block">
    <h2>Youth Representative Election</h2>
    

   </div>
    </div>
  </div>
  <a class="carousel-control-prev" style=" filter: invert(100%);" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon text-dark" aria-hidden="false"></span>
    <span class="sr-only">Previous</span>
  
  </a>

  <a class="carousel-control-next" style=" filter: invert(100%);" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="false"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
            </div>  -->
             
             

            </div> 

            </div>
          
        </div>
        </div>
        
      </div>
      <div class="container-fluid row ml-0">
        <div class="col-xl-12 ">
          <div class="card text-dark">
            <div class="card-header text-dark border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="ml-2"> Election Results</h3>
                </div>
                <!-- <div class="col text-right">
                  <a href="#!" class="btn btn-sm btn-primary">See all</a>
                </div> -->
              </div>
            </div>

            <div class="card-body">
            <div class="table-responsive ">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light text-dark ">
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Party</th>
                    <th scope="col">Post</th>
                    <th scope="col">Votes</th>
                    <!-- <th scope="col">Results out of</th> -->
                  </tr>
                </thead>
                <tbody  >
                <?php
//that newnew
$candidates_view ="SELECT totalvotes.UserID, users.Surname,users.OtherNames, users.Party, users.image,totalvotes.votes, totalvotes.TotalVotesByPost, totalvotes.ElectionType FROM totalvotes INNER JOIN users ON totalvotes.UserID=users.UserID ORDER BY ElectionType, votes DESC;";
 $view =$conn->query($candidates_view);
                while($rows=$view-> fetch_assoc()){
                  ?>
                  <tr>
                    <th scope="row">
                    <a  class="avatar rounded-circle mr-3">
                          <img src=" <?php print $rows['image']; ?> ">
                        </a> 
                
                                   <?php print $rows['OtherNames']."  ".$rows['Surname']; ?> 
                    </th>
                    <td>
                    <?php print $rows['Party']; ?>
                    </td>
                    <td>
                    <?php print $rows['ElectionType']; ?>
                    </td>
                    <td>
                    <?php print $rows['votes']; ?>   <?php print ' / '.$rows['TotalVotesByPost']; ?> 
                    </td>
                    <!-- <td>
                    <?php print ' / '.$rows['TotalVotesByPost']; ?> 
                    </td> -->
                  </tr>
                
                   
                </tbody>
                <?php
                }
                  ?>
              </table>
             
            </div>
            

           
          </div>
        </div>
        
        </div>  
        </div>
      </div>
       <!-- Footer -->
       <footer class="footer-main pt-0">
        <div class="container">
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
          </div>
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
  <!-- Optional JS -->
  <script src="../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.2.0"></script>


  <script type="text/javascript">

  $(window).on('resize',function(){location.reload();});
  </script>
  </body>

</html>
