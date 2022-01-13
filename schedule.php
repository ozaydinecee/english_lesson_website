<?php
session_start();
ob_start();
$conn = new mysqli("localhost", "root", "", "english");
if ($conn->connect_error) {
    die("connection failed: " . $conn->connect_error);
}
$courseid=$_GET["cid"];
$getId = $_GET["insid"];
$studentid = $_GET["id"];
$_SESSION["cid"]=$courseid;
$_SESSION["id"]=$studentid;
$_SESSION["insid"]=$getId;

$result = $conn->query("SELECT * FROM instructor  WHERE id = '{$getId}'");
$resultcourse = $conn->query("SELECT * FROM lesson  WHERE id = '{$courseid}'");
$instr_info = $result->fetch_array();
$course_info=$resultcourse->fetch_array();




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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


    <div class="container" style="color:white;">
    
        <form action="schedulingsubmit.php" method="get">
        <p>You are scheduling the course in <?= $course_info["date"] ?> at <?= $course_info["time"] ?></p>
        <p>from <?= $instr_info["name"] ?> <?= $instr_info["surname"] ?> </p>
        <input type="radio" id="thirty" name="duration" value="30 min">
        <label for="student">30 minutes</label>
        <input type="radio" id="one" name="duration" checked="checked" value="1 hour">
        <label for="instructor">1 hour</label>
        <div class="input-group">
				<button name="submit" class="btn btn-light">Schedule</button>
			</div>

        </form>
    </div>
</body>
</html>