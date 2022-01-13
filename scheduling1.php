
<?php
session_start();
ob_start();
$conn = new mysqli("localhost", "root", "", "english");
if ($conn->connect_error) {
    die("connection failed: " . $conn->connect_error);
}

$getId = $_GET["insid"];
$studentid = $_GET["id"];
$result = $conn->query("SELECT * FROM instructor  WHERE id = '{$getId}'");

$instr_info = $result->fetch_array();




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">

    <title>Document</title>
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
                        ?> <a class="nav-link" aria-current="page" href="index.php?profile=student&id=<?= $_GET['id'] ?>">Home</a>
                            <a class="nav-link" href="teachers.php?profile=student&id=<?= $_GET['id'] ?>">Teachers</a>
                            <a class="nav-link" href="student_reschedule.php?islem=liste&id=<?= $_GET['id'] ?>">My Lesson </a>
                         <a class="btn btn-primary btn-customized signup-menu" href="logout.php" role="button">Log Out</a>
                        <?php } else { ?>
                           <a class="btn btn-primary   login-menu" href="login.html" role="button">Log in</a>
                        <a class="btn btn-primary signup-menu" href="signin.html" role="button">Sign Up</a>
                        <?php } ?>
                </div>
            </div>
        </div>
</nav>
   <div class="container">
       <div class="row">
           <div class="col">
           <img src="assets/img/<?=$_GET["insid"]?>.jpg" class="rounded-circle" style="width: 320px" alt="">

           </div>
           <div class="col">
               <br><br><br>
               <h3 style="color:white;">Book lesson with</h3>
            <h3 style="color: wheat;"><?= $instr_info["name"] ?> <?= $instr_info["surname"] ?></h3>
            <h3 style="color:white;">now!</h3>
           </div>
           
           <div class="col md 6">
               <br><br><br>
           <form action="scheduling1.php?insid=<?=$_GET["insid"]?>&id=<?=$_GET["id"]?>" method="post" class="form-inline" style="color:white;"> 
            
            <div class="form-group">
                <div class="row">
                    <div class="col md 3">
                        <label for="date">Date:</label>
                    </div>
                    <div class="col md 9">
                        <input type="date" id="date" name="date" class="form-control mx-sm-3" aria-describedby="passwordHelpInline">
                        <small id="passwordHelpInline" class="text-muted"></small>
                    </div>
                </div>
            </div>
            <div class="container">
                <?php if(isset($_POST['date'])){
                    $thisdate=$_POST['date'];
                    echo '<div class="mt-3">'.$thisdate.'</div>';
                    echo '<div class="row justify-content-left">';
                    $result = $conn->query("SELECT * FROM lesson  WHERE date = '{$thisdate}' and  instructorid='{$_GET["insid"]}'  ORDER BY time");
                    
                    while($row = mysqli_fetch_array($result)){

                        if($row['schedulestatus']=="available"){
                        echo '<div class="col m-2"><a type="button" href="schedule.php?insid='.$getId.'&id='.$studentid.'&cid='.$row['id'].'" class="btn btn-dark btn-lg">'.$row['time'].'</a></div>';
                        }
                        else{
                            echo '<div class="col m-2"><button type="button" class="btn btn-dark btn-lg disabled">'.$row['time'].'</button></div>';
 
                        }
                    }
                    echo '</div>';

                    

                    
                }
                ?>    
            </div>
            <button class="btn btn-success mt-3" style="border-radius:1px solid black;" type="submit" id="btn"
                    name="submit" value="addNewLaptop">Look for lessons</button>
            </form>            

            

            
           
           </div>
           

       </div>
   </div>
   <footer style="background-color:gray;">
        <p> - Design made by Ece and Asli</a> </p>
    </footer>
</body>
</html>