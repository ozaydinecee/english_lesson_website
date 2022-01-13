<?php
$receiver="ozaydinecee@gmail.com";
$subject = "Email test";
$body= "slk";
$sender="From:englishlessoncomp@gmail.com";


if(mail($receiver, $subject, $body, $sender)){
    echo "successful";
}

else{
    echo "unsuccessful";
}