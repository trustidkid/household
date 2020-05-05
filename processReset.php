<?php

session_start();
require_once('functions/user.php');
require_once('functions/alert.php');

/**
 * PHPMAILER SETUP START
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//require "user/composer/autoload_real.php";
//require "/usr/local/bin/composer/autoload.php";
require_once 'vendor/autoload.php';

$mail = new PHPMailer();

$mail->isSMTP();
$mail->Host = 'smtp.mailtrap.io';
$mail->SMTPAuth = true;
$mail->Username = '854743967f9a4e'; 
$mail->Password = 'b0306ceb161ca1';
$mail->SMTPSecure = 'tls';
$mail->Port = 2525;

/**
 * PHPMAILER SETUP END
 */

//print_r($_POST);
$counterror = 0;
$email = $_POST['email'] != "" ? $_POST['email'] : $counterror++;
$password = $_POST['password'] != "" ? $_POST['password'] : $counterror++;
//get the token if user has not login
if(!isset($_SESSION['loggedIn'])){
    $token = $_POST['token'] != "" ? $_POST['token'] : $counterror++; 
    $_SESSION['token'] = $token; 
}
$_SESSION['email'] = $email;

if( $counterror > 0){

    $_SESSION['error'] = "You have " . $counterror . " error";

    if($counterror > 1) $_SESSION['error'] .= "s";

    $_SESSION['error'] .=  " in your form";

    header("location: reset.php");

}else{

    

    $tokenDirectory = scandir("db/tokens");

    for($counter = 0; $counter < count($tokenDirectory); $counter++){
        $currentuser = $email.".json";

        //confirm the email
        if($tokenDirectory[$counter] == $currentuser){
           // echo $currentuser;
          //  die();
            //save token
            $tokenString = file_get_contents("db/tokens/".$email.".json");
            $tokenObject = json_decode($tokenString);
            $tokenfromdb = $tokenObject -> token;

            //check if user already logged in
            if($_SESSION['loggedIn']){
                $checktoken = true;
            }else{
                $checktoken = $token == $tokenfromdb;
            }

            if($checktoken){
                //update user password

               $alluser = scandir("db/users/");
                for($count = 0; $count < count($alluser); $count++){
                    $currentuser = $alluser[$count];
                    if($currentuser = $email.".json"){
                        $userString = file_get_contents("db/users/".$currentuser);
                        $userObject = json_decode($userString); 
                        
                        //modify the password
                        $userObject -> password = password_hash($password, PASSWORD_DEFAULT);
                        //delete the existing file
                        unlink("db/users/".$currentuser);
                        //unlink("db/users/".$userObject['email'].".json");
                        

                        //save the updated user data to the database
                        file_put_contents("db/users/".$email.".json",json_encode($userObject));
                        //saveUser($userObject);                        

                        /**
                         * Inform user that was reset was successful
                         */

                         //send mail to

                        //TODO We can decide to delete the token after successful reset is completed.
                        //delete token
                        //unlink("db/token".$email);

                        //$to = $username;
                        $subject = "Password Reset Successful";
                        $message = "You password reset request was successful.";
                        $message .= "If this was not you please visit http://localhost:8080/household/forgot.php to reset your password";
                        //$headers = "From: yemi.bili@gmail.com" . "\r\n" .
                    // "CC: yemi.bili07@gmail.com";

                        $mail->setFrom('no-reply@snh.com', 'SNH Hospital');
                        $mail->addReplyTo('info@msnh.com', 'SNH');
                        $mail->addAddress($email, 'user'); 
                        $mail->addCC('yemi.bili07@gmail.com', 'client');
                        $mail->Subject = $subject;
                        $mail->isHTML(true);
                        $mail->Body = $message;

                        if($mail->send()){
                            set_alert("message","Password reset was successful for account ".$email);
                            header("location: logout.php");
                        }else{
                            $content = "Something went wrong. We cannot proceed further. Please try again later ".$username;
                            set_alert("error",$content);
                            echo 'Mailer Error: ' . $mail->ErrorInfo;
                            header("location: reset.php");
                        }

                        die();
                    }
            
                }
            
            }
            $content = "Invalid token or expired.";
            set_alert("error",$content);
            header("location: reset.php");
        }       

    }
    //email not not exist
    
    $content = "Email did not exist";
    set_alert("error",$content);
    header("location: reset.php");
    
}