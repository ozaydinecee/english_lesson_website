<?php

ob_start();
session_start();


//print_r($_SESSION);
$conn = new mysqli("localhost", "root", "", "english");
if ($conn->connect_error) {
	die("connection failed: " . $conn->connect_error);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top ">
        <div class="container">
            <a class="navbar-brand" href="">
                <img src="" style="width: 40px;" alt="">E-Lessons</a>
    
    
            <br>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    
                    <?php
                    if (isset($_SESSION['email'])){
                        ?> <a class="nav-link" aria-current="page" href="index.php?profile=<?= $_GET['profile'] ?>&id=<?= $_GET['id'] ?>">Home</a>
                            <a class="nav-link" href="teachers.php?profile=<?= $_GET['profile'] ?>&id=<?= $_GET['id'] ?>">Teachers</a>
                            <a class="nav-link" href="<?= $_GET['profile'] ?>_reschedule.php?islem=liste&id=<?= $_GET['id'] ?>">My Lesson </a>
                                <?php if ($_GET['profile']=='instructor'){
                                echo '<a class="nav-link" href="'. $_GET['profile'].'_add.php?islem=liste&id='. $_GET['id'].'">Add Lesson </a>
                                ';
                                }
                         ?>
                         <a class="btn btn-primary btn-customized signup-menu" href="logout.php" role="button">Log Out</a>
                        <?php } else { ?>
                           <a class="btn btn-primary   login-menu"  style="margin-right: 20px;" href="login.html" role="button">Log in</a>
                        <a class="btn btn-primary signup-menu" href="signin.html" role="button">Sign Up</a>
                        <?php } ?>
                        
                    
        
                </div>
            </div>
        </div>
    </nav>

<div>
    <img src="assets/img/student1.jpg" alt="">
</div>
        </div>    
        <div class="container" style="background-color:#c2bfbf;">
        <?php if (!isset($_SESSION['email'])){
                        echo' <div class="row" style="margin:30px 0px 60px 0px;">
                        <br><br>
                        <center><h5 style="font-size: 30px;" >Register now!</h5></center>
                        <br>
                        <center><h5>Decide your requirements and find tutors!</h5></center>
                        <br><br><br>
                        <center><a href="signin.html" class="button-53">Register and Book a Lesson</a></center>

                        </div>';
                        }  ?>
        
                            
                            <hr>
            <div class="row">
                <br>
                <center><img src="assets/img/world.png" style="width: 100px; margin-top:20px;" alt=""></center>
                <center><h6>Make the world your comfort zone</h6></center>
                        <center><h4>Speak naturally with professional online tutors</h4></center>
                <br>
                <br>
                <div class="col-md-4 services">
                
                    <img src="https://img.icons8.com/material-outlined/30/000000/certificate--v2.png"/>
               <br>
               <br>
               <h5>Expert tutors</h5>
               <p class="hide">Find native speakers and certified private tutors</p>
                </div>
                <div class="col-md-4 services">
                    
                <img src="https://img.icons8.com/ios-glyphs/30/000000/verified-account--v1.png"/>
               <br>
               <br>
               <h5>Verified profiles</h5>
               <p class="hide">We carefully check and confirm each tutor's profile</p>

                </div>
                <div class="col-md-4 services">
                <img src="https://img.icons8.com/ios-glyphs/30/000000/time--v1.png"/>
                <br>
                <br>
                    <h5 >Learn anytime</h5>
                    <p class="hide">Take lessons at the perfect time for your busy schedule</p>

                </div>
            </div>

            <hr>               
             <div class="row">
             <center><img src="https://img.icons8.com/external-vitaliy-gorbachev-fill-vitaly-gorbachev/90/000000/external-graduate-university-vitaliy-gorbachev-fill-vitaly-gorbachev.png"/></center>
                <center><h6>Focus on the skills you need</h6></center>
                        <center><h4>Prepare to achieve your goals with tutors</h4></center>
                        <br>
                        <br>
                <br>
                <br>
                <div class="col-md-6 services">
                
                <img style=""src="https://img.icons8.com/material-outlined/30/000000/bookmark-ribbon--v2.png"/>
               <br>
               <br>
               <h5>Immerse yourself in a new culture</h5>
               <p class="hide">Connect with language experts from around the world</p>
                </div>
                <div class="col-md-6 services">
                    
                <img src="https://img.icons8.com/ios-glyphs/30/000000/time--v1.png"/>
               <br>
               <br>
               <h5>Get expert help when you need it</h5>
               <p class="hide">Learn to solve any problem in English language</p>

                </div>
                <div class="col-md-6 services">
                <img src="https://img.icons8.com/material-outlined/30/000000/lightning-bolt--v2.png"/>
                <br>
                <br>
                    <h5 >Succeed in your career</h5>
                    <p class="hide">Develop your working vocabulary and communicate clearly</p>

                </div>
                <div class="col-md-6 services">
                <img src="https://img.icons8.com/ios-glyphs/30/000000/marker--v1.png"/>                <br>
                <br>
                    <h5 >Speak naturally</h5>
                    <p class="hide">Make a good impression and build trust in language</p>

                </div>
            

                            </div>

                            </div>   
                           
        </div>

        <footer style="background-color:gray;">
        <p> - Design made by Ece and Asli</a> </p>
    </footer>
    
</body>
</html>