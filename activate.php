<?php
session_start();
            $servername="localhost";
            $username="root";
            $password="";
            $dbname="english";
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
              die("connection failed: " . $conn->connect_error);
            }
            

            $userid=$_GET['id'];
            $thisprofile=$_GET['prof'];

            $sql= "UPDATE $thisprofile set status='active' WHERE id=$userid";
            $result=mysqli_query($conn, $sql);

            echo "<script>
                window.location.href='admin1.php';
                </script>";
