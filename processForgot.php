<?php

session_start();

require_once('functions/alert.php');
require_once('functions/user.php');

/**
 * PHP MAILER SETUP START
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
 * PHP MAILER SETUP END
 */
//print_r($_POST);
$counterror = 0;
$username = $_POST['email'] != "" ? $_POST['email'] : $counterror++;

if( $counterror > 0){

    $_SESSION['error'] = "You have " . $counterror . " error";

    if($counterror > 1) $_SESSION['error'] .= "s";

    $_SESSION['error'] .=  " in your form";

    header("location: forgot.php");

}else{

    $allusers = scandir("db/users");

    for($counter = 0; $counter < count($allusers); $counter++){
        $currentuser = $username.".json";
        //check for email
        if($allusers[$counter] == $currentuser){

            /**
             * GENERATING TOKEN CODE STARTS
             */
                $token = "";
                $alphabet = ['a','b','c','d','e','f','g','h','i','A','B','C','E','F','H',"I",'1','2'.'3','4','5','6','7','8','9','0'];
                for($i = 0; $i < 30; $i++){
                    //pick a number between 0 and total numbers in letters
                    $index = mt_rand(0,count($alphabet)-1);
                    $token .= $alphabet[$index];
                }
             /**
              * GENERATING TOKEN CODE STOPS
              */

            //send mail to
            
            //$to = $username;
            $subject = "Password Reset Link";
            $message = "You initated a request to reset your account password.";
            $message .= "If this was not from your please ignore. Otherwise, goto http://localhost:8080/household/resetpassword.php?token=".$token;
            //$headers = "From: yemi.bili@gmail.com" . "\r\n" .
           // "CC: yemi.bili07@gmail.com";

            $mail->setFrom('no-reply@snh.com', 'SNH Hospital');
            $mail->addReplyTo('info@msnh.com', 'Mailtrap');
            $mail->addAddress($username, 'Tim'); 
            $mail->addCC('yemi.bili07@gmail.com', 'Elena');
            $mail->Subject = $subject;
            $mail->isHTML(true);
            $mail->Body = $message;


            $date = date('Y-m-d H:m:s');
            //save token
            file_put_contents("db/tokens/".$username.".json", json_encode(['token' =>$token, 'date'=>$date]));

            if($mail->send()){
                set_alert("message","Password reset sent to your email ".$username);
                header("location: login.php");
            }else{
                $content = "Something went wrong. We cannot proceed further. Please try again later ".$username;
                set_alert("error",$content);
                echo 'Mailer Error: ' . $mail->ErrorInfo;
                header("location: forgot.php");
            }
            
           // $try = mail($to,$subject,$message,$headers);
           

            //TODO To re-check sending email
           /*
            if($try){
                set_alert("message","Password reset sent to your email ".$username);
               // $_SESSION['error'] = "Password reset sent to your email ".$username;
                header("location: login.php");

            }else{
    
                $content = "Something went wrong. We cannot proceed further. Please try again later ".$username;
                set_alert("error",$content);
                //$_SESSION['error'] = "Something went wrong. We cannot proceed further. Please try again later ".$username;
                header("location: forgot.php");

            } */
            die(); 
        }
        
    }
    $content = "Sorry! We don't have your email account in our record ".$username;
    set_alert("error", $content); 
    //$_SESSION['error'] = "Sorry! We don't have your email account in our record ".$username;
    header("location: forgot.php");
}