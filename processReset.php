<?php

session_start();
require_once('functions/user.php');
require_once('functions/alert.php');

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

    //TODO: To check why Reset Password failed.

    $tokenDirectory = scandir("db/tokens");

    for($counter = 0; $counter < count($tokenDirectory); $counter++){
        $currentuser = $email.".json";
       
        //echo $currentuser;
       // echo $tokenDirectory[$counter];
       /// die();

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

                //$userObject = findUser($email);
               // echo $userObject;
                //die();

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

                        $content = "Password reset successful. You can now login.";
                        set_alert("message",$content);
                        

                        /**
                         * Inform user that was reset was successful
                         */

                         //send mail to
                        $to = $username;
                        $subject = "Password Reset Successful";
                        $message = "Your password has been reset successfully. If this was not initiated from you. Please goto snh.org and reset the password.";
                        $headers = "From: no-reply@snh.com" . "\r\n" .
                        "CC: yemi.bili07@gmail.com";

                        //TODO We can decide to delete the token after successful reset is completed.
                        //delete token
                        //unlink("db/token".$email);

                        $try = mail($to,$subject,$message,$headers);

                        header("location: login.php");
                    }
            
                }
                die();
            
            }
        }       

        $content = "Password reset failed, token/email invalid or expired.";
        set_alert("error",$content);
        header("location: login.php");

    }
    
}