<?php

session_start();

require_once('functions/user.php');
require_once('functions/alert.php');

   $errorcount = 0;

   //if first name is empty increment errorcunt variable
   $appointmentdate = $_POST['appointmentdate'] !="" ? $_POST['appointmentdate'] : $errorcount++;
   $appointmenttime = $_POST['appointmenttime'] != "" ? $_POST['appointmenttime'] : "last name empty";
   $nature_of_appointment = $_POST['nature_of_appointment'] != "" ? $_POST['nature_of_appointment'] : $errorcount++;
   $complaint = $_POST['complaint'] != "" ? $_POST['complaint'] : $errorcount++;
   $department = $_POST['department'] != "" ? $_POST['department'] : $errorcount++;


   $_SESSION['appointmentdate'] = $appointmentdate;
   $_SESSION['appointmenttime'] = $appointmenttime;
   $_SESSION['nature_of_appointment'] = $nature_of_appointment;
   $_SESSION['complaint'] = $complaint;
   $_SESSION['department'] = $department;

   $email = $_SESSION['email'];
   if(isset($_SESSION['loggedIn'])){
        $email ="you are here";
    }

    //echo $email;
    //die();

   if( $errorcount > 0 ){
       //redirect back to register page
       // $content = "You have " . $errorcount . " error";
       // set_alert("error", $content);
        $_SESSION['error'] = "You have " . $errorcount . " error";

       if($errorcount > 1) $_SESSION['error'] .= "s";
   
       $_SESSION['error'] .=  " in your form";
       header('Location: appointment.php');
   }else{

    //auto generate ID
    $directory = "db/appointment";
    $allUsers = scandir($directory);
    $newAppointment  = (count($allUsers)-2) +1; //removes the leading two empty files in the directory

    $dateRegister =date('d-m-yy H:i:s');


    //create a json object
    $appointmentObject = [
        'id'=>$newAppointment,
        'appointmentdate'=>$appointmentdate,
        'appointmenttime'=> $appointmenttime,
        'nature_of_appointment'=>$nature_of_appointment,
        'complaint'=> $complaint,
        'department' => $department,
        'date' => $dateRegister
    ];

    //check that has not been booked before
    $appointmentExists = findAppointment($email);
    
    if($appointmentExists){

        $content = "Registration failed. appointment already exist";
        set_alert("error", $content);
        header("location: appointment.php");
        //terminate
        die();
    }
    
    //save user
    //saveUser($userObject);
    file_put_contents("db/appointment/".$email.".json",json_encode($appointmentObject));

    $content = "Thank you for contacting us! Please wait for your turn! ";
    set_alert("message",$content);
    //redirect
    header('location: patient.php');
   }

   
?>