<?php
session_start();
$studentid=$_SESSION['id'];
$insid=$_SESSION['insid'];
$courseid=$_SESSION['cid'];
$duration=$_GET['duration'];
$servername="localhost";
$username="root";
$password="";
$dbname="english";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error){
    die("conn failed". $conn->connect_error );

}
$sql= "UPDATE lesson SET instructorid='{$insid}', studentid='{$studentid}', schedulestatus='pending', duration='{$duration}' WHERE id='{$courseid}' ";
$conn->query($sql);

if($conn){

    

    $sender="From:englishlessoncomp@gmail.com";
    $sorgu="select s.email as s_email, s.name as s_name, s.surname as s_surname,
    i.name as i_name, i.surname i_surname, i.email i_email,
    l.date as l_date, l.time as l_time 
    from student s inner join lesson l on l.studentid=s.id inner join instructor i on l.instructorid=i.id 
    where l.id='{$courseid}'";
    $result=mysqli_query($conn, $sorgu);
    $row= mysqli_fetch_array($result);
    $ldate=$row['l_date'];
    $ltime=$row['l_time'];
    $iname=$row['i_name'];
    $isurname=$row['i_surname'];
    $sname=$row['s_name'];
    $ssurname=$row['s_surname'];
    $receiver=$row['i_email'];

    $body= "Hi $iname $isurname! \n
    $sname $ssurname has created a request for the lesson in $ldate at $ltime. Status of the lesson is now pending. \n Sign in to approve, reject or reschedule!";
    $subject = "E-lesson notification";
    if(mail($receiver, $subject, $body, $sender)){
       echo "successful";
   }
   else{
       echo "unsuccessful";
   }


  echo "<script>alert('Lesson Scheduled');
  window.location.href='student_reschedule.php?islem=liste&id=",$studentid,"';</script>";

}