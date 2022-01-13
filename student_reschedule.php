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
    $duration = $_POST['duration']; 
    
    $conn->query("UPDATE lesson SET schedulestatus='pending', date='{$date}', time='{$time}', duration='{$duration}' WHERE id='{$_GET["lessonid"]}'");

    $idsu=$_GET["lessonid"];

    if ($conn) {
       

        $sender="From:englishlessoncomp@gmail.com";
        $sorgu = $conn->query("select s.email as s_email, s.name as s_name, s.surname as s_surname,
        i.name as i_name, i.surname i_surname, i.email i_email,
        l.date as l_date, l.time as l_time 
        from student s inner join lesson l on l.studentid=s.id inner join instructor i on l.instructorid=i.id 
        where l.id=$idsu")->fetch(PDO::FETCH_ASSOC);
        
        $ldate=$sorgu['l_date'];
        $ltime=$sorgu['l_time'];
        $iname=$sorgu['i_name'];
        $isurname=$sorgu['i_surname'];
        $sname=$sorgu['s_name'];
        $ssurname=$sorgu['s_surname'];
        $receiver=$sorgu['i_email'];
  
        $body= "Hi $iname $isurname! \n 
        $sname $ssurname has updated the lesson in $ldate at $ltime. Status of the lesson is now pending. \n Sign in to approve, reject or reschedule!";
        $subject = "E-lesson notification";
        if(mail($receiver, $subject, $body, $sender)){
           echo "successful";
       }
       else{
           echo "unsuccessful";
       }
  
            echo"<script>
                    alert('Lesson Updated');
                    window.location.href='student_reschedule.php?islem=liste&id=",$_GET['id'],"';
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
    <link rel="stylesheet" href="student_reschedule.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
<style>
    body{
       background-color: #28223F;
    }
</style>

    
    <title>My lessons</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top ">
        <div class="container">
            <a class="navbar-brand" href=""> E-Lessons</a>
    
    
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

    <?php
    switch(@$_GET["islem"]) {
        case "duzenle":
    ?>
    <?php
    $oku = $conn->query("SELECT * FROM lesson WHERE id='{$_GET["lessonid"]}'")->fetch(PDO::FETCH_ASSOC);
    $student_id=$_GET["id"];
    ?>
    <div class="container">
        <div class="main-panel">
                        <div class="content-wrapper">
                           <div class="row" style="color:white;">
                              <div class="col-12 grid-margin stretch-card">
                                 <div class="card" style="width: 300px;    margin: 100px 100px 100px 600px;">
                                    <div class="card-body">
                                       <h4 class="card-title">re-schedule</h4>
                                       <p class="card-description">
                                       update lesson
                                       </p>
                                       <form action="student_reschedule.php?islem=duzenle&lessonid=<?=$oku["id"]?>&id=<?=$student_id?>" method="post" enctype="multipart/form-data">
                                          
                                             <div class="form-group">
                                                <label>Date:</label> 
                                                <input type="date" class="form-control" value="<?=$oku["date"]?>" name="date" placeholder="date">
                                                
                                             </div>
                                          

                                          <div class="form-group">
                                             <label >Time</label>
                                             <input type="time" class="form-control" value="<?=$oku["time"]?>" name="time" placeholder="time">
                                             
                                          </div>

                                          <div class="form-group">
                                             <label >Duration:</label>
                                             <input type="text" class="form-control" value="<?=$oku["duration"]?>" name="duration" placeholder="duration">
                                             
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
                     </div>

    <?php
    break;
    case "liste";
    ?>
    
    <div class="container">
    <table id="customers">
    
    <!-- <?php                       
            $id = $_GET['id']; 
            $query = $conn->query("SELECT * FROM student WHERE id = '{$id}'")->fetch(PDO::FETCH_ASSOC);
            
               ?>
    
         <p><span><?=$query["name"] ?> </span>'s Lessons</p> -->
    <tr>
    
               <th scope="col">Date</th>
               <th scope="col">Time</th>
               <th scope="col">Duration</th>
               <th scope="col">Approval Information</th>
               <th scope="col">Instructor Information</th>
               <th scope="col">Update Lesson Detail</th>
               <th scope="col">Cancel</th>
               

            </tr>
        <?php                       
               $sorgu = $conn->query("select instructor.name as i_name,
                                instructor.surname as i_surname,
                                      lesson.date,
                                      lesson.time,
                                      lesson.id,
                                      lesson.studentid,
                                      lesson.duration,
                                      lesson.schedulestatus
                                             from lesson 
                                  inner join instructor on instructor.id=lesson.instructorid WHERE lesson.studentid='{$_GET["id"]}' order by lesson.id;
                  
              ");
                   foreach ($sorgu as $row) {
               ?>
            <tr>
               <td><?=$row["date"]?></td>
               <td><?=$row["time"]?></td>
               <td><?=$row["duration"]?></td>
               <td><?=$row["schedulestatus"]?></td>
               <td><?=$row["i_name"]?> <?=$row["i_surname"]?></td>
               <th><a class="btn btn-light" href="?islem=duzenle&lessonid=<?=$row["id"];?>&id=<?=$_GET["id"]?>" >  update lesson details </a></th>
               <th><a class="btn btn-danger" href="?islem=sil&lessonid=<?=$row["id"];?>&id=<?=$_GET["id"]?>" > cancel </a></th>
               
            </tr>
            <?php
               }?>
         
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
                 window.location.href='student_reschedule.php?islem=liste&id=",$_GET['id'],"';
                </script>";
    }
    ?>
    <?php
    default:
    //
    break;
    }
    ?>
<br><br><br><br>
<footer style="background-color:gray;">
        <p> - Design made by Ece and Asli</a> </p>
    </footer>
</body>
</html>
<table class="table">

        