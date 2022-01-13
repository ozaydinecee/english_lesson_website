<?php

$email = $_POST['email'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$pw = $_POST['password'];
$profile = $_POST['profile'];
$servername="localhost";
$username="root";
$password="";
$dbname="english";

$api_key = "8abc6788ff2a4c8f8cf6e9d753011a62";

$ch = curl_init();


curl_setopt_array($ch, [
    CURLOPT_URL => "https://emailvalidation.abstractapi.com/v1/?api_key=$api_key&email=$email",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true
]);

$response = curl_exec($ch);

curl_close($ch);

$data = json_decode($response, true);


$result='';
if ($data['deliverability'] === "UNDELIVERABLE") {
    echo "<script>
    alert('Undeliverable e-mail address. Please check your email address');
    window.location.href='signin.html';
    </script>";
    $result='this';
}


if ($data["is_disposable_email"]["value"] === true){
    echo "<script>
    alert('Disposable e-mail address. Please check your email address');
    window.location.href='signin.html';
    </script>";
    $result='this';
}


    if($result!='this'){
    $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error){
                die("conn failed". $conn->connect_error );

            }
            $sql= "INSERT INTO `$profile` ( `name`, `surname`, `email`, `password`) VALUES ('$name', '$surname', '$email', '$pw') ";
            if($conn->query($sql)===TRUE){
                echo "data inserted successfully";
                header("Location: index.php");
            }
            else{
                echo "error". $sql . "<br>". $conn->error;

            }
        $conn->close();
    }

?>