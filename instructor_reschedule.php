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
     
      
   
    
    $schedulestatus = $_POST['schedulestatus']; 
    $date = $_POST['date']; 
    $time = $_POST['time']; 
    $duration = $_POST['duration']; 
    $lessonid=$_GET['lessonid'];
    
    $conn->query("UPDATE lesson SET schedulestatus='{$schedulestatus}', date='{$date}', time='{$time}', duration='{$duration}' WHERE id='{$_GET["lessonid"]}'");
    
$con = new mysqli($servername, $username, $password, $dataname);
if ($con->connect_error){
    die("conn failed". $con->connect_error );

}

if ($conn) {

   $sender="From:englishlessoncomp@gmail.com";
   $sorgu="select s.email as s_email, s.name as s_name, i.name as i_name, i.surname i_surname, l.date as l_date, l.time as l_time from student s inner join lesson l on l.studentid=s.id inner join instructor i on l.instructorid=i.id where l.id=$lessonid";
   $result=mysqli_query($con, $sorgu);
   $row= mysqli_fetch_array($result);
   $receiver=$row['s_email'];
   $ldate=$row['l_date'];
   $ltime=$row['l_time'];
   $iname=$row['i_name'];
   $isurname=$row['i_surname'];

   $body= "Your lesson in $ldate at $ltime is $schedulestatus by $iname $isurname.";
   $subject = "E-lesson notification";
   if(mail($receiver, $subject, $body, $sender)){
      echo "successful";
  }
  else{
      echo "unsuccessful";
  }


    echo"<script>
               alert('Lesson Updated');
               window.location.href='instructor_reschedule.php?islem=liste&id=",$_GET['id'],"';
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
    <link rel="stylesheet" href="instructor_reschedule.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">


    
    <title>My lessons</title>
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
                            <a class="nav-link" href="<?= $_GET['profile'] ?>_reschedule.php?islem=liste&id=<?= $_GET['id'] ?>">My Lesson </a>
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
    ?>
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
                                       <form action="instructor_reschedule.php?islem=duzenle&lessonid=<?=$oku["id"]?>&id=<?=$instructor_id?>"  method="post" enctype="multipart/form-data">
                                          
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

                                          <div class="form-group">
                                             
                                             
                                             <label for="approve" >Select situation:</label>
                                                <select name="schedulestatus" class="form-control" value="<?=$oku["schedulestatus"]?>"> 
                                                <option >pending</option>
                                                
                                                <option >approved</option>
                                                </select>
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
    <table >
       <br><br><br><br><br><br><br>
    <p style="font-size:32px;">My Lesson</p>      
    <tr>
               
               <th scope="col" style="color:white;">Date</th>
               <th scope="col"style="color:white;">Time</th>
               <th scope="col"style="color:white;">Duration</th>
               <th scope="col"style="color:white;">Student Information</th>
               <th scope="col"style="color:white;">Schedule Status</th>
               <th scope="col"style="color:white;">Approve</th>
               <th scope="col"style="color:white;">Cancel</th>
               

            </tr>
        <?php                       
               $sorgu = $conn->query("select student.name as s_name,
                                      student.surname as s_surname,
                                      lesson.date,
                                      lesson.time,
                                      lesson.id,
                                      lesson.instructorid,
                                      lesson.schedulestatus,
                                      lesson.duration
                                             from lesson 
                                  inner join student on student.id=lesson.studentid WHERE lesson.instructorid='{$_GET["id"]}'order by lesson.id;
                  
              ");
                   foreach ($sorgu as $row) {
                      if($row['schedulestatus']=="pending"){
                         echo'
                         <tr style="color:red;">
                            <td>'. $row['date'] . '</td>
                            <td>'. $row['time'] . '</td>
                            <td>'. $row['duration'] . '</td>
                            <td>'. $row['s_name'] . ' '. $row['s_surname'] . '</td>
                            <td>'. $row['schedulestatus'] . '</td>

                            <th><a class="btn btn-light" href="?islem=duzenle&lessonid='. $row['id'] . '&id='.$_GET["id"].'" > approve or update </a></th>
                            <th><a class="btn btn-danger" href="?islem=sil&lessonid='. $row['id'] . '&id='.$_GET["id"].'" > cancel </a></th>
                         </tr>';
                        }
                        else if($row['schedulestatus']=="approved"){
                           echo'
                           <tr style="color:white;">
                              <td>'. $row['date'] . '</td>
                              <td>'. $row['time'] . '</td>
                              <td>'. $row['duration'] . '</td>
                              <td>'. $row['s_name'] . ' '. $row['s_surname'] . '</td>
                            <td>'. $row['schedulestatus'] . '</td>

                              <th><a class="btn btn-light" href="?islem=duzenle&lessonid='. $row['id'].'&id='.$_GET["id"]. '" > approve or update </a></th>
                              <th><a class="btn btn-danger" href="?islem=sil&lessonid='. $row['id'] . '&id='.$_GET["id"].'" > cancel </a></th>
                           </tr>';
                        }
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
                 window.location.href='instructor_reschedule.php?islem=liste&id=",$_GET['id'],"';
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


        