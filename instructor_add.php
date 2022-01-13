<?php
session_start();
ob_start();
$servername = "localhost";
$username = "root";
$password = "";
$dataname = "english"; 
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dataname", $username, $password);
    $conn->exec("set names utf8");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
} catch(PDOException $e) {
    //echo "Connection failed: ". $e->getMessage();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST'){	 
   if($_GET["islem"] == "duzenle"){
      
         
      
     
      $date = $_POST['date']; 
      $time = $_POST['time']; 
      
      $conn->query("UPDATE lesson SET  date='{$date}', time='{$time}' WHERE id='{$_GET["lessonid"]}'");

      if ($conn) {
            echo"<script>
                  alert('Lesson Updated');
                  window.location.href='instructor_add.php?islem=liste&id=",$_GET['id'],"';
                  </script>";

                  
      }
   }





   if($_GET["islem"] == "ekle"){
       
      // resim ekle
      $date = $_POST['date'];
      $time = $_POST['time'];
      $instructorid=$_GET['id'];
      echo $instructorid;


      $sql = "INSERT INTO lesson (date, time, schedulestatus, instructorid) VALUES ('".$date."', '".$time."', 'available', '".$instructorid."')";
      
      
      if($conn->query($sql)){
         echo"<script>
         alert('Lesson Added');
         window.location.href='instructor_add.php?islem=liste&id=",$_GET['id'],"';
        </script>";
      }
                          
    
      
                      
             
      
    
   }
 }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="instructor_add.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">


    
    <title>My Available Lessons</title>
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
                        ?> <a class="nav-link" aria-current="page" href="index.php?profile=instructor&id=<?= $_GET['id'] ?>">Home</a>
                            <a class="nav-link" href="teachers.php?profile=instructor&id=<?= $_GET['id'] ?>">Teachers</a>
                            <a class="nav-link" href="instructor_reschedule.php?islem=liste&id=<?= $_GET['id'] ?>">My Lesson </a>
                            <a class="nav-link" href="instructor_add.php?islem=liste&id=<?=$_GET['id']?>">Add Lesson </a>
                         <a class="btn btn-primary btn-customized signup-menu" href="logout.php" role="button">Log Out</a>
                        <?php } else { ?>
                           <a class="btn btn-primary   login-menu" href="login.html" role="button">Log in</a>
                        <a class="btn btn-primary signup-menu" href="signin.html" role="button">Sign Up</a>
                        <?php } ?>
                    
        
                </div>
            </div>
        </div>
    </nav>
    <?php
    switch(@$_GET["islem"]) {
        case "duzenle":
    ?>
    <?php
    $oku = $conn->query("SELECT * FROM lesson WHERE id='{$_GET["lessonid"]}'")->fetch(PDO::FETCH_ASSOC);
    $instructor_id=$_GET["id"];
    ?> <br><br><br><br><br>
        <div class="main-panel">
                        <div class="content-wrapper">
                           <div class="row" style="color:white;">
                              <div class="col-12 grid-margin stretch-card" style="width: 300px;    margin: 100px 100px 100px 600px;">
                                 <div class="card"  >
                                    <div class="card-body">
                                       <h4 class="card-title">re-schedule</h4>
                                       <p class="card-description">
                                       update lesson
                                       </p>
                                       <form action="instructor_add.php?islem=duzenle&lessonid=<?=$oku["id"]?>&id=<?=$instructor_id?>"  method="post" enctype="multipart/form-data">
                                          
                                             <div class="form-group">
                                                <label>Date:</label> 
                                                <input type="date" class="form-control" value="<?=$oku["date"]?>" name="date" placeholder="date">
                                                
                                             </div>
                                          

                                          <div class="form-group">
                                             <label >Time</label>
                                             <input type="time" class="form-control" value="<?=$oku["time"]?>" name="time" placeholder="time">
                                             
                                          </div>

                                       
                                          
                                          <br>
                                          <input type="submit" value="Save"class="btn btn-primary mr-2"  name="submit" placeholder="submit">
                                          
                                    </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>


    <?php
    break;
    case "liste";
    ?>
    
    <div class="container containersu">
       <br><br><br><br><br><br><br><br><br>
    <table >
       <div class="row">
          <div class="col">
             <p style="font-size:32px;">My Available Lessons</p>
    
    </div>
    <div class="col">
    <a class="btn btn-dark" style="float:right;" href="?islem=ekle&id=<?=$_GET['id']?>" > Add Lesson </a>  
    </div>  
    </div>    
    <tr>
               
               <th scope="col">Date</th>
               <th scope="col">Time</th>
               <th scope="col">Update Lesson</th>
               <th scope="col">Cancel</th>
               
               

            </tr>
        <?php                       
               $sorgu = $conn->query("select * from lesson  WHERE instructorid='{$_GET["id"]}'
                                    and schedulestatus='available' order by date;
                  
              ");
                   foreach ($sorgu as $row) {
                      
                         echo'
                         <tr style="color:black;">
                            <td>'. $row['date'] . '</td>
                            <td>'. $row['time'] . '</td>
                            <th><a class="btn btn-light" href="?islem=duzenle&lessonid='. $row['id'] . '&id='.$_GET["id"].'" > Update Lesson </a></th>
                            <th><a class="btn btn-danger" href="?islem=sil&lessonid='. $row['id'] . '&id='.$_GET["id"].'" > cancel </a></th>
                         </tr>';
                        
                     }
                        ?>
                        
         
      </table>
      </div>
      

<?php
    break;
    case "sil";
    ?>
    <?php 
    $sql=$conn->query("DELETE FROM lesson WHERE id='{$_GET["lessonid"]}'");
    
    if ($sql) {
         echo"<script>
                 alert('Lesson Deleted');
                 window.location.href='instructor_add.php?islem=liste&id=",$_GET['id'],"';
                </script>";


              
                
    }
    ?>
      <?php
      break;
      case "ekle";
      ?>

            <div class="main-panel">
                                    <div class="content-wrapper">
                                       <div class="row" style="color:white;">
                                          <div class="col-12 grid-margin stretch-card">
                                             <div class="card" style="width: 300px;    margin: 100px 100px 100px 600px;">
                                                <div class="card-body">
                                                   <h4 class="card-title">Add Available Lesson</h4>
                                                   <p class="card-description">
                                                   add lesson
                                                   </p>
                                                   <form action="instructor_add.php?islem=ekle&id=<?=$_GET['id']?>"  method="post" enctype="multipart/form-data">
                                                      
                                                         <div class="form-group">
                                                            <label>Date:</label> 
                                                            <input type="date" class="form-control" value="" name="date" placeholder="date">
                                                            
                                                         </div>
                                                      

                                                      <div class="form-group">
                                                         <label >Time</label>
                                                         <input type="time" class="form-control" value="" name="time" placeholder="time">
                                                         
                                                      </div>
                     
                                                      


                                                      
                                                      
                                                      <br>
                                                      <input type="submit" value="Save"class="btn btn-primary mr-2"  name="submit" placeholder="submit">
                                                      
                                                </div>
                                                </form>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>







    <?php
    default:
    //
    break;
    }
    ?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<footer style="background-color:gray;" >
        <p> - Design made by Ece and Asli</a> </p>
    </footer>
</body>
</html>
<table class="table">

        