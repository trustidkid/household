<?php

session_start();
//print_r($_POST);
$counterror = 0;
$username = $_POST['email'] != "" ? $_POST['email'] : $counterror++;

if( $counterror > 0){

    $_SESSION['error'] = "You have " . $counterror . " error";

    if($counterror > 1) $_SESSION['error'] .= "s";

    $_SESSION['error'] .=  " in your form";

    header("location: login.php");

}else{

    $allusers = scandir("db/users");

    for($counter = 0; $counter < count($allusers); $counter++){
        $currentuser = $username.".json";
        //check for email
        if($allusers[$counter] == $currentuser){

            //send mail to
            $to = $username;
            $subject = "Password Reset Link";
            $message = "You initated a request to reset your account password.";
            $message .= "If this was not from your please ignore. Otherwise, goto http://localhost:8080/household/resetpassword.php";
            $headers = "From: info@snh.com" . "\r\n" .
            "CC: yemi.bili07@gmail.com";

            $try = mail($to,$subject,$message,$headers);

           // print_r($try);
           // die();
            if($try){
                $_SESSION['error'] = "Password reset sent to your email ".$username;
    header("location: login.php");

            }else{
                $_SESSION['error'] = "Sorry! We don't have your email account in our record ".$username;
    header("location: forgot.php");

            }
            die(); 
        }
        
    }
}