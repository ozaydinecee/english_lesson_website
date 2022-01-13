<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="admin.css">
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
                    if ($_SESSION['email']== 'admin@gmail.com'){
                        ?> 

                         <a class="btn btn-primary btn-customized signup-menu" href="logout.php" role="button">Log Out</a>
                        
                        <?php } ?>
                    
        
                </div>
            </div>
        </div>
    </nav>
  
            <?php

            $servername="localhost";
            $username="root";
            $password="";
            $dbname="english";
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
              die("connection failed: " . $conn->connect_error);
            }

            

            
            $thisprofile='student';
            $inactiveUsers= "SELECT * from $thisprofile";
            $result=mysqli_query($conn, $inactiveUsers);
            echo "<br><br><br><br><style>body {
              color: azure;
            }</style>
            <div class='container'><h4>Students</h4><table class='table table-borderless'>
            <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Surname</th>
    <th>Email</th>
    <th>Status</th>
    <th>Activate</th>
    </tr>";

    while($row = mysqli_fetch_array($result))
    {
      if($row['status']=="inactive"){
        echo '<tr>
        <td class="item-id">'. $row['id'] . '</td>
        <td class="item-name">' . $row['name'] . '</td>
        <td>' . $row['surname'] . '</td>
        <td>' . $row['email'] . '</td>
        <td>' . $row['status'] . '</td>
        <td><a class="btn btn-info" style="color: white;" href="activate.php?id=' . $row['id'] . '&prof='.$thisprofile.'">activate</a></td>';
        
      }
      else{
        echo '<tr>
        <td class="item-id">'. $row['id'] . '</td>
        <td class="item-name">' . $row['name'] . '</td>
        <td>' . $row['surname'] . '</td>
        <td>' . $row['email'] . '</td>
        <td>' . $row['status'] . '</td>';
      }
   
    }
    echo "</table></div>";

    $thisprofile='instructor';
    $inactive= "SELECT * from $thisprofile";
            $res=mysqli_query($conn, $inactive);
            echo "<div class='container'><h4>Instructors </h4><table class='table table-borderless'>
            <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Surname</th>
    <th>Email</th>
    <th>Status</th>
    <th>Activate</th>
    </tr>";

    while($row = mysqli_fetch_array($res))
    {
      if($row['status']=="inactive"){
        echo '<tr>
        <td class="item-id">'. $row['id'] . '</td>
        <td class="item-name">' . $row['name'] . '</td>
        <td>' . $row['surname'] . '</td>
        <td>' . $row['email'] . '</td>
        <td>' . $row['status'] . '</td>
        <td><a class="btn btn-info" style="color: white;" href="activate.php?id=' . $row['id'] . '&prof='.$thisprofile.'">activate</a></td>';
        
      }
      else{
        echo '<tr>
        <td class="item-id">'. $row['id'] . '</td>
        <td class="item-name">' . $row['name'] . '</td>
        <td>' . $row['surname'] . '</td>
        <td>' . $row['email'] . '</td>
        <td>' . $row['status'] . '</td>';
      }
   
    }
    echo "</table></div>";

    $sorgu1= "SELECT id from instructor";
    $result1=mysqli_query($conn, $sorgu1);

    $sorgu2= "SELECT id from student";
    $result2=mysqli_query($conn, $sorgu2);


    echo '<div class="container"><form action="admin1.php" method="post">

    <div class="row m-5">
      <div class="col">
                      <div class="form-group">
                      <label for="approve" >Instructor ID:</label>
                                                  <select name="instructorid" class="form-control" value="">
                                                  <option>none</option>
                                                  ';
                                                  while($row = mysqli_fetch_array($result1)){
                                                    echo '<option>'.$row['id'].'</option>';

                                                  }
      echo'
                                                  </select>
                          
                      </div>
      </div>
      <div class="col">
                      <div class="form-group">
                      <label for="approve" >Student ID:</label>
                                                  <select name="studentid" class="form-control" value=""> 
                                                  <option>none</option>
                                                  ';
                                                  while($row = mysqli_fetch_array($result2)){
                                                    echo '<option>'.$row['id'].'</option>';

                                                  }
      echo'
                                                  </select>
                          
                      </div>
      </div>
  
      <div class="col">
                      <div class="form-group">
                      <label for="datestart" >Date from:</label>
                      <input type="date" id="datestart" name="datestart" class="form-control" aria-describedby="passwordHelpInline">
                          <small id="passwordHelpInline" class="text-muted"></small>
                      </div>
      </div>
      <div class="col">
                      <div class="form-group">
                      <label for="dateend" >Date to:</label>
                      <input type="date" id="dateend" name="dateend" class="form-control" aria-describedby="passwordHelpInline">
                          <small id="passwordHelpInline" class="text-muted"></small>
                      </div>
                      <button class="btn btn-success mt-3" style="border-radius:1px solid black;" type="submit" id="btn"
                      name="submit" value="addNewLaptop">Look for lessons</button>
      </div>
    </div>
    
  </form>
  </div>';

  if(isset($_POST['submit'])){
    echo "<div class='container'><h4>Instructor ID: {$_POST['instructorid']}</h4>
    <h4>Student ID: {$_POST['studentid']}</h4>
    <h4>Date: {$_POST['datestart']} to {$_POST['dateend']}</h4></div>";
    echo "<div class='container'><table class='table table-borderless'>
            <tr>
    <th>Instructor ID</th>
    <th>Instructor Name</th>
    <th>Student ID</th>
    <th>Student Name</th>
    <th>Lesson Date</th>
    <th>Lesson Time</th>
    </tr>";
    $thisquery="";

    if($_POST['studentid']=="none"&&$_POST['instructorid']=="none"){
      $start=$_POST['datestart'];
      $end=$_POST['dateend'];
      $iid=$_POST['instructorid'];
      $sid=$_POST['studentid'];
      $thisresult = $conn->query("select s.name s_name, s.surname s_surname, s.id s_id,  
      i.id i_id, i.name i_name, i.surname i_surname, l.date l_date, 
      l.time l_time from student s right join lesson l on s.id=l.studentid 
      left join instructor i on i.id=l.instructorid where l.date between '{$start}' and '{$end}' order by l.date
      ");

      
    }

    if($_POST['studentid']=="none"&&$_POST['instructorid']!="none"){

      $start=$_POST['datestart'];
      $end=$_POST['dateend'];
      $iid=$_POST['instructorid'];
      $thisresult=$conn->query("select s.name s_name, s.surname s_surname, s.id s_id,  
      i.id i_id, i.name i_name, i.surname i_surname, l.date l_date, 
      l.time l_time from student s right join lesson l on s.id=l.studentid 
      left join instructor i on i.id=l.instructorid where i.id=$iid and  l.date between '{$start}' and '{$end}' order by l.date
      ");
      
    }

    if($_POST['studentid']!="none"&&$_POST['instructorid']=="none"){
      $start=$_POST['datestart'];
      $end=$_POST['dateend'];
      $sid=$_POST['studentid'];
      $thisresult=$conn->query("select s.name s_name, s.surname s_surname, s.id s_id,  
      i.id i_id, i.name i_name, i.surname i_surname, l.date l_date, 
      l.time l_time from student s right join lesson l on s.id=l.studentid 
      left join instructor i on i.id=l.instructorid where s.id=$sid and  l.date between '{$start}' and '{$end}' order by l.date
      ");
    }

    if($_POST['studentid']!="none" && $_POST['instructorid']!="none"){
      $sid=$_POST['studentid'];
      $iid=$_POST['instructorid'];
      $start=$_POST['datestart'];
      $end=$_POST['dateend'];
      $thisresult=$conn->query("select s.name s_name, s.surname s_surname, s.id s_id,  
      i.id i_id, i.name i_name, i.surname i_surname, l.date l_date, 
      l.time l_time from student s right join lesson l on s.id=l.studentid 
      left join instructor i on i.id=l.instructorid where s.id=$sid and i.id=$iid and  l.date between '{$start}' and '{$end}' order by l.date
      ");
    }
    
    // if(empty($thisresult)){
    //   echo 'bok';
    //  }

    while($row = mysqli_fetch_array($thisresult)){
      
      
      echo '<tr>
        <td>'. $row['i_id'] . '</td>
        <td>' . $row['i_name'].' ' .$row['i_surname']. '</td>
        <td>' . $row['s_id'] . '</td>
        <td>' . $row['s_name'] . ' ' .$row['s_surname']. '</td>
        <td>' . $row['l_date'] . '</td>
        <td>' . $row['l_time'] . '</td>';

       
    }
    echo '</div></table>';
  
  }

    ?>
    
    <br><br><br><br>

    

    <footer style="background-color:gray;">
        <p> - Design made by Ece and Asli</a> </p>
    </footer>  
</body>
</html>