<?php
session_start();
ob_start();
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
    <title>Teachers</title>
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
                           <a class="btn btn-primary   login-menu" href="login.html" role="button">Log in</a>
                        <a class="btn btn-primary signup-menu" href="signin.html" role="button">Sign Up</a>
                        <?php } ?>
                    
        
                </div>
            </div>
        </div>
    </nav>

    <br><br><br><br><br>


    <?php
			$sql = "SELECT * FROM instructor WHERE status='active' ORDER BY id ";
			$result = mysqli_query($conn, $sql);

			foreach ($result as $instructor) {
				
	?>
    <div class="card-container" style="margin-bottom:5px;">
        <div class="row">
        <!-- <img class="round" src="https://randomuser.me/api/portraits/women/79.jpg" alt="user" /> -->

       <div class="col-md-6"> 
           <div class="col">
           <img src="assets/img/<?= $instructor["id"] ?>.jpg" class="rounded-circle" style="width: 200px" alt="">
           <br><br>
           </div>
           
        
        </div>
       <div class="col-md-6">
           <br>
       <h3><?= $instructor["name"] ?> <span><?= $instructor["surname"] ?></span></h3>
       <br>

        <div class="buttons">
            <a href="scheduling1.php?insid=<?= $instructor["id"] ?>&profile=<?= $_GET['profile'] ?>&id=<?= $_GET['id'] ?>" class="btn primary">Message</a>
            
            <a href="scheduling1.php?insid=<?= $instructor["id"] ?>&profile=<?= $_GET['profile'] ?>&id=<?= $_GET['id'] ?>" class="btn primary ghost">Book a trial lesson!</a>
        </div>
        
    </div>
</div>
    </div>
    <?php
		}
				
	?>
    <footer style="background-color:gray;">
        <p> - Design made by Ece and Asli</a> </p>
    </footer>
</body>
</html>