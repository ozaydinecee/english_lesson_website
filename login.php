<?php
session_start();
$email=$_POST['email'];
$pw=$_POST['password'];
$profile=$_POST['action'];
$servername="localhost";
$username="root";
$password="";
$dbname="english";




$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error){
    die("conn failed". $conn->connect_error );

}

$sql= "SELECT * from $profile WHERE email='$email' AND password='$pw'";
$result=mysqli_query($conn, $sql);
$row= mysqli_fetch_array($result);


    if($row['email']=="admin@gmail.com" && $row['password']==$pw){
        $_SESSION['email']=$email;
        echo "<script>
                    alert('Welcome admin');
                    window.location.href='admin1.php';
                    </script>";
    }
    elseif ($row['email']==$email && $row['password']==$pw && $row['status']=='active'){

        $_SESSION['email']=$email;
        echo "<script>
                    alert('Welcome to english lesson');
                    window.location.href='index.php?profile=",$profile,"&id=",$row["id"],"';
                    </script>";

    }
    else{
        echo "<script>
        alert('Check your e-mail and password.');
        window.location.href='login.html';
        </script>";
    }


    
